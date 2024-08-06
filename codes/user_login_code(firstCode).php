<?php
// this code is without proper brutfroce and google recaptcha error message with first time code

include 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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

    function recordLoginAttempt($pdo, $ip, $user_id, $status) {
        $stmt = $pdo->prepare("INSERT INTO login_attempts (ip_address, user_id, status) VALUES (:ip, :user_id, :status)");
        $stmt->execute(['ip' => $ip, 'user_id' => $user_id, 'status' => $status]);
    }
    
    function checkLoginAttempts($pdo, $ip, $user_id, $timeBound) {
        // Get the current time
        $currentTime = new DateTime();
        $timeBoundInterval = $currentTime->modify("-{$timeBound} minutes")->format('Y-m-d H:i:s');
    
        // Check the most recent successful login attempt within the timebound
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM login_attempts 
            WHERE ip_address = :ip 
            AND user_id = :user_id 
            AND status = 'success' 
            AND attempt_time > :time_bound_interval
        ");
        $stmt->execute(['ip' => $ip, 'user_id' => $user_id, 'time_bound_interval' => $timeBoundInterval]);
        $recent_successful_logins = $stmt->fetchColumn();
    
        if ($recent_successful_logins > 0) {
            // If there was a successful login, count failed attempts after that time
            $stmt = $pdo->prepare("
                SELECT COUNT(*) 
                FROM login_attempts 
                WHERE ip_address = :ip 
                AND user_id = :user_id 
                AND status = 'failed' 
                AND attempt_time > (
                    SELECT MAX(attempt_time) 
                    FROM login_attempts 
                    WHERE ip_address = :ip 
                    AND user_id = :user_id 
                    AND status = 'success'
                )
            ");
            $stmt->execute(['ip' => $ip, 'user_id' => $user_id]);
        } else {
            // If there was no successful login, count all failed attempts in the last timebound
            $stmt = $pdo->prepare("
                SELECT COUNT(*) 
                FROM login_attempts 
                WHERE ip_address = :ip 
                AND user_id = :user_id 
                AND status = 'failed' 
                AND attempt_time > :time_bound_interval
            ");
            $stmt->execute(['ip' => $ip, 'user_id' => $user_id, 'time_bound_interval' => $timeBoundInterval]);
        }
    
        return $stmt->fetchColumn();
    }
    

    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // sanitizing username
    $username = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    $user_id = $username;
    $recaptcha_secret = '6Ldhux4qAAAAAINa7sj-ogBFxsiAM6CXe3IUYKdQ';
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $ip = getUserIP();
    $timeBound = 2; // in minute
    $max_attempts = 2;
    // $latitude = $_POST['latitude'];
    $latitude = 12345;
    // $longitude = $_POST['longitude'];
    $longitude = 98765;

    if (checkLoginAttempts($pdo, $ip, $user_id, $timeBound) >= $max_attempts) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Too many login attempts. Retry login after'.$timeBound,
            'redirect' => '#'
        ]);
        exit;
    }

    // Make the request to verify the token
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
    // // Custom filtering to allow specific characters
    $username = preg_replace('/[^a-zA-Z0-9@.]/', '', $username);
    $password = $_POST['password'];

    // matching the entered username and filtered username
    if ($username === $_POST['email']) {

    $stmt = $pdo->prepare('SELECT * FROM all_user_data WHERE email_id = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user) {
        // Verify the entered password against the stored hash
        if (password_verify($password, $user['password'])) {
            // check whethere the account is approved
            if($user['is_approved']==1){
            //check whethere account is active
            if($user['status']=="Active"){
        //store session after successfull match
        // (password_verify($user['password'], $password)){}
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email_id'] = $user['email_id'];
        $_SESSION['emp_id'] = $user['emp_id'];

        $_SESSION['username'] = $user['username'];
        $_SESSION['user_first_name'] = $user['user_first_name'];
        $_SESSION['is_logged_in'] = true;
        // Prepare JSON response for Success
        $response = array(
            'status' => 'success',
            'message' => 'Login successful!',
            'redirect' => 'audit-list.php'
        );
        recordLoginAttempt($pdo, $ip, $user_id, 'success', $latitude, $longitude);
        // if ($password === '12345') {
        //     $_SESSION['requires_password_change'] = true;
        //     // Prepare JSON response for password change
        // $response = array(
        //     'status' => 'success',
        //     'message' => 'Please Change Default Password!',
        //     'redirect' => 'change-default-password.php'
        // );
        //     // echo json_encode(['status' => 'success', 'role' => $user['role'], 'requires_password_change' => true]);
        // } else {
        //     $_SESSION['requires_password_change'] = false;
        //     $response = array(
        //         'status' => 'success',
        //         'message' => 'Password change not required',
        //         'redirect' => 'dashboard.php'
        //     );
        //     // echo json_encode(['status' => 'success', 'role' => $user['role'], 'requires_password_change' => false]);
        // }
        // else for status statement
    }else{
        
        $response = array(
            'status' => 'error',
            'message' => 'Your Account is ' . $user['status']. '. Please Contact Admin',
            'redirect' => '#'
        );
    }
            // else for is_approved statement
    }else{
        $response = array(
            'status' => 'error',
            'message' => 'Account Approval is Pending. Please Try After Sometime',
            'redirect' => '#'
        );
    }
        // user and password not matched else condition
    } else {
        recordLoginAttempt($pdo, $ip, $user_id, 'failed', $latitude, $longitude);
        $response = array(
            'status' => 'error',
            'message' => 'Incorrect Password',
            'redirect' => '#'
        );
        // echo json_encode(['status' => 'error']);
    } 
// else condition for if user not found
}else{
    recordLoginAttempt($pdo, $ip, $user_id, 'failed', $latitude, $longitude);
        $response = array(
            'status' => 'error',
            'message' => 'User ID Not Found',
            'redirect' => '#'
        );
        
    }
    // else condition for filtering username
} else{
    $response = array(
        'status' => 'error',
        'message' => 'Entered UserID is Invalid',
        'redirect' => '#'
        );
    }
    // The reCAPTCHA failed
    } else {
        recordLoginAttempt($pdo, $ip, $user_id, 'failed', $latitude, $longitude);
        $response = array(
            'status' => 'error',
            'message' => 'Login failed: Invalid reCAPTCHA.',
            'redirect' => '#'
        );
    }
    // Send JSON response for Result in the frontend
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
    // else condition if not a Post Request
    } else {
        echo '<script>alert("You are Not Allowed To This Page"); window.location.href = "../index.php";</script>';
    }
?>
