<?php
include "../include/auth.php";

header('Content-Type: application/json');
require_once 'config.php';

try {
    // Get request parameters and sanitize them
    $filters = [
        'start_date' => filter_input(INPUT_GET, 'start_date', FILTER_SANITIZE_STRING),
        'end_date' => filter_input(INPUT_GET, 'end_date', FILTER_SANITIZE_STRING),
        'state' => filter_input(INPUT_GET, 'state', FILTER_SANITIZE_STRING),
        'location' => filter_input(INPUT_GET, 'location', FILTER_SANITIZE_STRING),
        'created_by' => filter_input(INPUT_GET, 'created_by', FILTER_SANITIZE_STRING),
        'bank' => filter_input(INPUT_GET, 'bank', FILTER_SANITIZE_STRING),
        'status' => filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING),
    ];

    // Build query based on filters
    $query = "
        SELECT 
            audit_list.audit_number,
            bca_and_bcpoint_details.bca_id,
            bca_and_bcpoint_details.bca_name,
            bca_and_bcpoint_details.bca_contact_no,
            bca_and_bcpoint_details.bca_bank,
            bca_and_bcpoint_details.state,
            bca_and_bcpoint_details.location,
            audit_list.status AS audit_status,
            audit_list.created_date AS audit_date,
            CONCAT(all_user_data.user_first_name, ' ', all_user_data.user_last_name) AS created_by_full_name
        FROM 
            audit_list
        INNER JOIN 
            bca_and_bcpoint_details 
        ON 
            audit_list.audit_number = bca_and_bcpoint_details.audit_number 
        LEFT JOIN
            all_user_data
        ON 
            audit_list.created_by_id = all_user_data.user_id
        WHERE 
            1=1
    ";

    $params = [];

    if ($filters['start_date']) {
        $query .= " AND audit_list.created_date >= :start_date";
        $params[':start_date'] = $filters['start_date'];
    }

    if ($filters['end_date']) {
        $query .= " AND audit_list.created_date <= :end_date";
        $params[':end_date'] = $filters['end_date'];
    }

    if ($filters['state']) {
        $query .= " AND bca_and_bcpoint_details.state = :state";
        $params[':state'] = $filters['state'];
    }

    if ($filters['location']) {
        $query .= " AND bca_and_bcpoint_details.location = :location";
        $params[':location'] = $filters['location'];
    }

    if ($filters['created_by']) {
        $query .= " AND CONCAT(all_user_data.user_first_name, ' ', all_user_data.user_last_name) = :created_by";
        $params[':created_by'] = $filters['created_by'];
    }

    if ($filters['bank']) {
        $query .= " AND bca_and_bcpoint_details.bca_bank = :bank";
        $params[':bank'] = $filters['bank'];
    }

    if ($filters['status']) {
        $query .= " AND audit_list.status = :status";
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
        $filename = "Audit_List_Data_" . date("Y-m-d_H-i-s") . ".csv";
        $filePath = __DIR__ . '/../report/csv/' . $filename;

        // Ensure the directory exists
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true)) {
                throw new Exception('Failed to create directory.');
            }
        }

        // Create the CSV file
        $output = fopen($filePath, 'w');
        if ($output === false) {
            throw new Exception('Failed to open file for writing.');
        }

        // CSV column headings
        fputcsv($output, ['SL No', 'Audit Number', 'BCA ID', 'BCA Full Name', 'Mobile No', 'BCA Bank', 'State', 'Location', 'Audit Status', 'Audit Date', 'Created By']);

        $sl_no = 1;
        foreach ($result as $row) {
            // Convert the date format
            $dbDate = new DateTime($row['audit_date']);
            $csvDate = $dbDate->format('d-M-Y');
            fputcsv($output, [
                $sl_no++,
                $row['audit_number'],
                $row['bca_id'],
                $row['bca_name'],
                $row['bca_contact_no'],
                $row['bca_bank'],
                $row['state'],
                $row['location'],
                $row['audit_status'],
                $csvDate,
                $row['created_by_full_name']
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

