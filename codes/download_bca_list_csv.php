<?php
include "../include/auth.php";
// $filename = "BCA_Data_" . date("Y-m-d_H-i-s") . ".csv";
// $filePath = __DIR__ . '/../report/csv/' . $filename;

// header("Content-Disposition: attachment; filename=\"$filename\"");


header('Content-Type: application/json');
require_once 'config.php';

try {
    // Get request parameters and sanitize them
    $filters = [
        'state' => filter_input(INPUT_GET, 'state', FILTER_SANITIZE_STRING),
        'created_by' => filter_input(INPUT_GET, 'created_by', FILTER_SANITIZE_STRING),
        'bank' => filter_input(INPUT_GET, 'bank', FILTER_SANITIZE_STRING),
        'status' => filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING),
    ];

    // Build query based on filters
    $query = "
        SELECT *
        FROM 
            all_bc_details
        WHERE 
            1=1
    ";

    $params = [];

    if ($filters['state']) {
        $query .= " AND all_bc_details.state = :state";
        $params[':state'] = $filters['state'];
    }

    if ($filters['created_by']) {
        $query .= " AND CONCAT(all_user_data.user_first_name, ' ', all_user_data.user_last_name) = :created_by";
        $params[':created_by'] = $filters['created_by'];
    }

    if ($filters['bank']) {
        $query .= " AND all_bc_details.bca_bank = :bank";
        $params[':bank'] = $filters['bank'];
    }

    if ($filters['status']) {
        $query .= " AND all_bc_details.status = :status";
        $params[':status'] = $filters['status'];
    }

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);

    foreach ($params as $key => $value) {
        $stmt->bindParam($key, $value);
    }

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        $filename = "BCA_Data_" . date("Y-m-d_H-i-s") . ".csv";
        $filePath = __DIR__ . '/../report/csv/' . $filename;

        // Ensure the directory exists
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true)) {
                throw new Exception('Failed to create directory.');
            }
        }

        // Create the CSV file
        // $output = fopen('php://output', 'w');
        $output = fopen($filePath, 'w');
        if ($output === false) {
            throw new Exception('Failed to open file for writing.');
        }

        // CSV column headings
        fputcsv($output, ['SL No', 'BCA ID', 'BCA Full Name', 'Mobile No', 'BCA Bank', 'State', 'Location', 'Account Status', 'Created Date', 'Created By']);

        $sl_no = 1;
        foreach ($result as $row) {
            // Convert the date format
            $dbDate = new DateTime($row['created_date']);
            $csvDate = $dbDate->format('d-M-Y');
            fputcsv($output, [
                $sl_no++,
                $row['bca_id'],
                $row['first_name'],
                $row['bca_contact_no'],
                $row['bca_bank'],
                $row['state'],
                $row['location'],
                $row['status'],
                $csvDate,
                $row['created_by_id']
            ]);
        }

        fclose($output);

        // Return the file download URL
        $downloadUrl = '/bcaudit/codes/download_csv_file.php?filename=' . urlencode($filename);

        echo json_encode(['success' => true, 'downloadUrl' => $downloadUrl]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No data found.']);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
} finally {
    if (isset($pdo)) {
        unset($pdo);
    }
}
?>

