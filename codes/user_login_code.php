<?php
// login code with brutfroce and google recaptcha funtionality
include 'config.php';

if (session_status() == PHP_SESSION_NONE) {
    // Secure session configuration
    session_start([
    'cookie_lifetime' => 86400, // 1 day
    'cookie_httponly' => true,  // Make the cookie accessible only through the HTTP protocol
    'use_strict_mode' => true,  // Use strict session ID mode
    'use_cookies' => true,      // Use cookies to store the session ID on the client side
    'cookie_secure' => isset($_SERVER['HTTPS']), // Ensure the cookie is only sent over HTTPS
    'cookie_samesite' => 'Strict', // Strict same-site cookie policy
    ]);
}

function getUserIP() {
    if (isset($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    if (isset($_SERVER['HTTP_X_FORWARDED'])) return $_SERVER['HTTP_X_FORWARDED'];
    if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (isset($_SERVER['HTTP_FORWARDED_FOR'])) return $_SERVER['HTTP_FORWARDED_FOR'];
    if (isset($_SERVER['HTTP_FORWARDED'])) return $_SERVER['HTTP_FORWARDED'];
    if (isset($_SERVER['REMOTE_ADDR'])) return $_SERVER['REMOTE_ADDR'];
    return 'UNKNOWN';
}

function recordLoginAttempt($pdo, $username, $ip, $status) {
    $stmt = $pdo->prepare("INSERT INTO login_attempts (username, ip_address, attempt_time, status) VALUES (:username, :ip, NOW(), :status)");
    $stmt->execute(['username' => $username, 'ip' => $ip, 'status' => $status]);
}

function checkLoginAttempts($pdo, $username, $ip) {
    $userTimeBound = 5; // 5 minutes
    $userLimit = 3; // 5 attempts
    $ipTimeBound1 = 10; // 10 minutes
    $ipLimit1 = 10; // 10 attempts
    $ipTimeBound2 = 15; // 15 minutes
    $ipLimit2 = 20; // 20 attempts

    $stmt = $pdo->prepare("
        SELECT attempt_time, is_permanently_blocked, block_expiry 
        FROM login_attempts 
        WHERE username = :username 
        ORDER BY attempt_time DESC 
        LIMIT 1
    ");
    $stmt->execute(['username' => $username]);
    $userBlock = $stmt->fetch();

    if ($userBlock && ($userBlock['is_permanently_blocked'] || ($userBlock['block_expiry'] && strtotime($userBlock['block_expiry']) > time()))) {
        return [
            'status' => 'blocked',
            'blocked_type' => 'user',
            'permanent' => $userBlock['is_permanently_blocked'],
            'remaining_time' => $userBlock['is_permanently_blocked'] ? 0 : strtotime($userBlock['block_expiry']) - time(),
        ];
    }

    $stmt = $pdo->prepare("
        SELECT attempt_time, is_permanently_blocked, block_expiry 
        FROM login_attempts 
        WHERE ip_address = :ip 
        ORDER BY attempt_time DESC 
        LIMIT 1
    ");
    $stmt->execute(['ip' => $ip]);
    $ipBlock = $stmt->fetch();

    if ($ipBlock && ($ipBlock['is_permanently_blocked'] || ($ipBlock['block_expiry'] && strtotime($ipBlock['block_expiry']) > time()))) {
        return [
            'status' => 'blocked',
            'blocked_type' => 'ip',
            'permanent' => $ipBlock['is_permanently_blocked'],
            'remaining_time' => $ipBlock['is_permanently_blocked'] ? 0 : strtotime($ipBlock['block_expiry']) - time(),
        ];
    }

    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM login_attempts 
        WHERE username = :username 
        AND status = 'failed' 
        AND attempt_time > NOW() - INTERVAL :time_bound MINUTE
    ");
    $stmt->execute(['username' => $username, 'time_bound' => $userTimeBound]);
    $failedUserAttempts = $stmt->fetchColumn();

    if ($failedUserAttempts >= $userLimit) {
        blockUser($pdo, $username, $userTimeBound); // Block the user
        return [
            'status' => 'blocked',
            'blocked_type' => 'user',
            'permanent' => false,
            'remaining_time' => $userTimeBound * 60,
        ];
    }

    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM login_attempts 
        WHERE ip_address = :ip 
        AND status = 'failed' 
        AND attempt_time > NOW() - INTERVAL :time_bound MINUTE
    ");
    $stmt->execute(['ip' => $ip, 'time_bound' => $ipTimeBound1]);
    $failedIPAttempts1 = $stmt->fetchColumn();

    if ($failedIPAttempts1 >= $ipLimit1) {
        blockIP($pdo, $ip, $ipTimeBound1); // Block IP tempurary
        return [
            'status' => 'blocked',
            'blocked_type' => 'ip',
            'permanent' => false,
            'remaining_time' => $ipTimeBound1 * 60,
        ];
    }

    $stmt->execute(['ip' => $ip, 'time_bound' => $ipTimeBound2]);
    $failedIPAttempts2 = $stmt->fetchColumn();

    if ($failedIPAttempts2 >= $ipLimit2) {
        blockIP($pdo, $ip, 0, true); // Block IP permanently
        return [
            'status' => 'blocked',
            'blocked_type' => 'ip',
            'permanent' => true,
            'remaining_time' => 0,
        ];
    }

    return ['status' => 'allowed', 'remaining_attempts' => $userLimit - $failedUserAttempts - 1, 'blocked_type' => null];
}

function blockUser($pdo, $username, $timeBound) {
    $expiryTime = new DateTime();
    $expiryTime->modify("+{$timeBound} minutes");

    $stmt = $pdo->prepare("
        UPDATE login_attempts 
        SET is_blocked = TRUE, block_expiry = :expiry_time
        WHERE username = :username 
        AND attempt_time > NOW() - INTERVAL :time_bound MINUTE
    ");
    $stmt->execute(['username' => $username, 'time_bound' => $timeBound, 'expiry_time' => $expiryTime->format('Y-m-d H:i:s')]);
}

function blockIP($pdo, $ip, $timeBound, $permanent = false) {
    if ($permanent) {
        $stmt = $pdo->prepare("
            UPDATE login_attempts 
            SET is_blocked = TRUE, is_permanently_blocked = TRUE
            WHERE ip_address = :ip
        ");
    } else {
        $expiryTime = new DateTime();
        $expiryTime->modify("+{$timeBound} minutes");

        $stmt = $pdo->prepare("
            UPDATE login_attempts 
            SET is_blocked = TRUE, block_expiry = :expiry_time
            WHERE ip_address = :ip 
            AND attempt_time > NOW() - INTERVAL :time_bound MINUTE
        ");
        $stmt->execute(['ip' => $ip, 'time_bound' => $timeBound, 'expiry_time' => $expiryTime->format('Y-m-d H:i:s')]);
    }
    $stmt->execute(['ip' => $ip]);
}

function resetLoginAttempts($pdo, $username, $ip) {
    $stmt = $pdo->prepare("
        UPDATE login_attempts 
        SET is_blocked = FALSE, is_permanently_blocked = FALSE, block_expiry = NULL
        WHERE (username = :username OR ip_address = :ip)
        AND status = 'failed'
    ");
    $stmt->execute(['username' => $username, 'ip' => $ip]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    $user_id = $username;
    $recaptcha_secret = '6Ldhux4qAAAAAINa7sj-ogBFxsiAM6CXe3IUYKdQ';
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $ip = getUserIP();
    $latitude = 12345;
    $longitude = 98765;

    $checkAttempts = checkLoginAttempts($pdo, $username, $ip);
    $remainingAttempts = $checkAttempts['remaining_attempts'] ?? 0;

    if ($checkAttempts['status'] === 'blocked') {
        $remaining_time = $checkAttempts['remaining_time'];
        $remaining_minutes = floor($remaining_time / 60);
        $remaining_seconds = $remaining_time % 60;
        $formatted_remaining_time = "{$remaining_minutes} minutes and {$remaining_seconds} seconds";

        echo json_encode([
            'status' => 'error',
            'message' => $checkAttempts['permanent'] ? 'Your account is permanently blocked.' : 'You are temporarily blocked.',
            'blocked_type' => $checkAttempts['blocked_type'],
            'remaining_time' => $formatted_remaining_time
        ]);
        exit;
    }

    // Verify reCAPTCHA
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
        'remoteip' => $ip
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($recaptcha_data)
        ]
    ];

    $context  = stream_context_create($options);
    $recaptcha_verify = file_get_contents($recaptcha_url, false, $context);
    $recaptcha_success = json_decode($recaptcha_verify)->success;

    if ($recaptcha_success) {
        $stmt = $pdo->prepare("SELECT * FROM all_user_data WHERE email_id = :email");
        $stmt->execute(['email' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($_POST['password'], $user['password'])) {
            recordLoginAttempt($pdo, $username, $ip, 'success');

        // Regenerate the session ID to prevent session fixation
        session_regenerate_id(true);

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email_id'] = $user['email_id'];
            $_SESSION['emp_id'] = $user['emp_id'];

            $_SESSION['username'] = $user['username'];
            $_SESSION['user_first_name'] = $user['user_first_name'];
            $_SESSION['is_logged_in'] = true;
            
            echo json_encode(['status' => 'success', 'message' => 'Login successful', 'redirect' => '/bcaudit/audit-list.php']);
        } else {
            recordLoginAttempt($pdo, $username, $ip, 'failed');
            echo json_encode(['status' => 'error', 'message' => 'Invalid username or password', 'remaining_attempts' => $remainingAttempts]);
        }
    } else {
        recordLoginAttempt($pdo, $username, $ip, 'failed');
        echo json_encode(['status' => 'error', 'message' => 'reCAPTCHA verification failed', 'remaining_attempts' => $remainingAttempts]);
    }
}
?>
