<?php
include "../include/auth.php";

// Function to count the total number of rows in the CSV file
function countRowsInCSV($csvFile)
{
    $handle = fopen($csvFile, 'r');
    $rowCount = 0;

    if ($handle !== false) {
        while (fgetcsv($handle, 1000, ',') !== false) {
            $rowCount++;
        }
        fclose($handle);
    }

    return $rowCount;
}

// Function to upload a CSV file (WITHOUT deleting old files)
function uploadCSVFile()
{
    if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $uploadDir = __DIR__ . '/upload-csv/';

    // Create folder if not exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Generate unique file name
    $originalName = pathinfo($_FILES['csv_file']['name'], PATHINFO_FILENAME);
    $extension = pathinfo($_FILES['csv_file']['name'], PATHINFO_EXTENSION);

    $newFileName = $originalName . '_' . time() . '.' . $extension;
    $targetFile = $uploadDir . $newFileName;

    // Move uploaded file
    if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $targetFile)) {
        return $targetFile;
    }

    return false;
}

// Handle upload request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $csvFile = uploadCSVFile();

    if ($csvFile !== false) {

        // Count total rows
        $totalRows = countRowsInCSV($csvFile);

        echo json_encode([
            'success'   => true,
            'totalRows' => $totalRows,
            'file'      => basename($csvFile)
        ]);
    } else {

        echo json_encode([
            'error'   => true,
            'message' => 'CSV upload failed. Please try again.'
        ]);
    }
}
?>
