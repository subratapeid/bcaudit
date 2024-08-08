<?php
require_once "../include/auth.php";
require_once "config.php";

// Capture filters from URL parameters
$filters = [
    'state' => filter_input(INPUT_GET, 'state', FILTER_SANITIZE_STRING),
    'created_by' => filter_input(INPUT_GET, 'created_by', FILTER_SANITIZE_STRING),
    'bank' => filter_input(INPUT_GET, 'bank', FILTER_SANITIZE_STRING),
    'status' => filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING),
];

// Build the SQL query based on filters
$query = "
    SELECT 
        ab.bca_id,
        CONCAT(ab.first_name, ' ', IFNULL(ab.middle_name, ''), ' ', ab.last_name) AS bca_name,
        ab.bca_contact_no,
        ab.bca_bank,
        ab.state,
        ab.location,
        ab.status,
        DATE_FORMAT(ab.created_date, '%d-%b-%Y') AS created_date,
        CONCAT(aud.user_first_name, ' ', aud.user_last_name) AS created_by
    FROM 
        all_bc_details ab
    JOIN 
        all_user_data aud 
    ON 
        ab.created_by_id = aud.user_id 
    WHERE 
        1=1
";

$params = [];

if ($filters['state']) {
    $query .= " AND ab.state = :state";
    $params[':state'] = $filters['state'];
}

if ($filters['created_by']) {
    $query .= " AND CONCAT(aud.user_first_name, ' ', aud.user_last_name) = :created_by";
    $params[':created_by'] = $filters['created_by'];
}

if ($filters['bank']) {
    $query .= " AND ab.bca_bank = :bank";
    $params[':bank'] = $filters['bank'];
}

if ($filters['status']) {
    $query .= " AND ab.status = :status";
    $params[':status'] = $filters['status'];
}

// Set headers to initiate file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="BCA_Data_' . date('Y-m-d_H-i-s') . '.csv"');
header('Cache-Control: no-store, no-cache');
$output = fopen('php://output', 'w');

$header = ['Sl No', 'BCA ID', 'Full Name', 'Mobile No', 'Bank', 'State', 'Location', 'Status', 'Created Date', 'Created By'];
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
