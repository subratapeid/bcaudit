<?php
session_start();
$host = 'localhost';
$db = 'bc_audit';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Capture filters from URL parameters
$filters = [
    'state' => filter_input(INPUT_GET, 'state', FILTER_SANITIZE_STRING),
    'created_by' => filter_input(INPUT_GET, 'created_by', FILTER_SANITIZE_STRING),
    'bank' => filter_input(INPUT_GET, 'bank', FILTER_SANITIZE_STRING),
    'status' => filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING),
];

// Build the SQL query based on filters
$query = "
    SELECT *
    FROM all_bc_details
    
    WHERE 1=1
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

// Set headers to initiate file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="large_data_export.csv"');
header('Cache-Control: no-store, no-cache');
$output = fopen('php://output', 'w');

// Write the header of the CSV
$header = ['Column1', 'Column2', 'Column3']; // Add your column headers
fputcsv($output, $header);

$limit = 100;
$offset = 0;

while (true) {
    // Add limit and offset to the query
    $pagedQuery = $query . " LIMIT :limit OFFSET :offset";
    $stmt = $conn->prepare($pagedQuery);
    
    // Bind the parameters for the filters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind the parameters for pagination
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        break; // Exit the loop when no more rows are returned
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($output, $row);
    }

    $offset += $limit;
    ob_flush(); // Flush the output buffer
    flush();
}

fclose($output);

$conn = null; // Close the database connection
session_destroy(); // Reset progress

?>
