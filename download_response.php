<?php
$file = $_GET['file'] ?? '';

$baseDir = __DIR__ . '/codes/response/';
$filePath = realpath($baseDir . $file);

// Security check
if (!$file || !file_exists($filePath) || strpos($filePath, realpath($baseDir)) !== 0) {
    http_response_code(404);
    exit('File not found');
}

header('Content-Description: File Transfer');
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));

readfile($filePath);
exit;
