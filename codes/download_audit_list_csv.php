<?php
include "../include/auth.php";

header('Content-Type: application/json');
require_once 'config.php';

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
            DATE_FORMAT(audit_list.created_date, '%d-%b-%Y') AS created_date,
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
        $params[':start_date'] = $filters['start_date'] . ' 00:00:00'; // Start of the day
    }
    
    if ($filters['end_date']) {
        $query .= " AND audit_list.created_date <= :end_date";
        $params[':end_date'] = $filters['end_date'] . ' 23:59:59'; // End of the day
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

// Set headers to initiate file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Audit_List_' . date('Y-m-d_H-i-s') . '.csv"');
header('Cache-Control: no-store, no-cache');
$output = fopen('php://output', 'w');

$header = ['SL No', 'Audit Number', 'BCA ID', 'BCA Full Name', 'Mobile No', 'BCA Bank', 'State', 'Location', 'Audit Status', 'Audit Date', 'Created By'];
fputcsv($output, $header);

$limit = 1000;
$offset = 0;
$serialNumber = 1;

while (true) {
    // Add limit and offset to the query
    $pagedQuery = $query . " LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($pagedQuery);
    
    // Bind the parameters for the filters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind the parameters for pagination
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        if ($offset === 0) {
            // If no rows are found and this is the first iteration, write "No data found"
            fputcsv($output, ['No data found']);
        }
        break; // Exit the loop when no more rows are returned
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Add the serial number to the beginning of the row
        $row = array_merge([$serialNumber], $row);
        fputcsv($output, $row);
        $serialNumber++; // Increment the serial number
    }

    $offset += $limit;
    ob_flush();
    flush();
}

fclose($output);
$pdo = null;

?>

