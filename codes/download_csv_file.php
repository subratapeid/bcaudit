<?php
include "../include/auth.php";

header('Content-Type: application/json');

// Get filename from get parameters
$filename = isset($_GET['filename']) ? $_GET['filename'] : '';
$filePath = __DIR__ . '../../report/csv/' . $filename;

// Check if file exists
if (file_exists($filePath)) {
    // Set headers for file download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));

    // Read the file and output it
    readfile($filePath);

    // Delete the file after download
    unlink($filePath);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => `File not found.'$filePath`]);
}
?>
