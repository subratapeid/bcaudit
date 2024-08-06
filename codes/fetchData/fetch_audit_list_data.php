 <?php
  include "../../include/auth.php";
    require_once('../config.php');
    try {
    // SQL query to retrieve data
    $sql = "SELECT 
    a.audit_number,
    a.status,
    DATE_FORMAT(a.created_date, '%d-%m-%y') AS created_date,
    DATE_FORMAT(a.created_date, '%d-%b-%Y') AS formatted_date,
    b.state,
    b.location,
    b.bca_bank,
    c.bca_id,
    b.bca_name AS bca_full_name,
    CONCAT(u.user_first_name,' ',user_last_name) AS user_full_name,
    b.bca_contact_no
FROM 
    audit_list a
JOIN 
    bca_and_bcpoint_details b ON a.audit_number = b.audit_number
JOIN 
    all_bc_details c ON b.bca_id = c.bca_id
JOIN 
    all_user_data u ON a.created_by_id = u.user_id";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all rows as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output data as JSON
    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode([]);
    }

} catch (PDOException $e) {
    // Handle any errors
    echo "Connection failed: " . $e->getMessage();
}

unset($pdo);


?>


