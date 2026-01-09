<?php
include "../include/auth.php";
require_once('config.php');
include 'common/getDateTime.php';

header('Content-Type: application/json');

/**
 * Standard JSON response helper
 */
function sendResponse(bool $status, string $message): void {
    echo json_encode([
        'status'  => $status,
        'message' => $message
    ]);
    exit;
}

/**
 * Split full name into first, middle, last
 */
function splitFullName(string $fullName): array {
    $parts = array_values(array_filter(explode(' ', trim($fullName))));
    $count = count($parts);

    if ($count === 1) {
        return [
            'first_name'  => $parts[0],
            'middle_name' => '',
            'last_name'   => ''
        ];
    }

    if ($count === 2) {
        return [
            'first_name'  => $parts[0],
            'middle_name' => '',
            'last_name'   => $parts[1]
        ];
    }

    return [
        'first_name'  => $parts[0],
        'middle_name' => implode(' ', array_slice($parts, 1, -1)),
        'last_name'   => end($parts)
    ];
}

/* ---------------------------------------------------
   Allow only POST
--------------------------------------------------- */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request');
}

/* ---------------------------------------------------
   Validate logged-in user
--------------------------------------------------- */
$created_by = $_SESSION['user_id'] ?? null;

if (!$created_by) {
    sendResponse(false, 'User not authenticated');
}

/* ---------------------------------------------------
   Get & validate inputs
--------------------------------------------------- */
$bca_id   = trim($_POST['bca_id'] ?? '');
$fullName = trim($_POST['bca_full_name'] ?? '');

if ($bca_id === '' || $fullName === '') {
    sendResponse(false, 'All fields are required');
}

/* ---------------------------------------------------
   Split name
--------------------------------------------------- */
$nameParts  = splitFullName($fullName);
$first_name = $nameParts['first_name'];
$middle_name = $nameParts['middle_name'];
$last_name  = $nameParts['last_name'];

$created_at = getDateTime();

/* ---------------------------------------------------
   Check duplicate BCA ID
--------------------------------------------------- */
$checkStmt = $pdo->prepare("
    SELECT 1 FROM all_bc_details WHERE bca_id = :bca_id LIMIT 1
");
$checkStmt->execute([':bca_id' => $bca_id]);

if ($checkStmt->fetch()) {
    sendResponse(false, 'BCA ID already exists');
}

/* ---------------------------------------------------
   Insert into DB
--------------------------------------------------- */
try {

    $stmt = $pdo->prepare("
        INSERT INTO all_bc_details 
        (
            bca_id,
            first_name,
            middle_name,
            last_name,
            created_date,
            created_by_id
        )
        VALUES 
        (
            :bca_id,
            :first_name,
            :middle_name,
            :last_name,
            :created_date,
            :created_by_id
        )
    ");

    $stmt->execute([
        ':bca_id'        => $bca_id,
        ':first_name'    => $first_name,
        ':middle_name'   => $middle_name,
        ':last_name'     => $last_name,
        ':created_date'  => $created_at,
        ':created_by_id' => $created_by
    ]);

    sendResponse(true, 'BCA added successfully');

} catch (PDOException $e) {

    error_log('DB ERROR: ' . $e->getMessage());

    sendResponse(false, 'Database error, please try again'. $e);
}
