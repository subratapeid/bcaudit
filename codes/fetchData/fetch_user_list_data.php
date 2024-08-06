 <?php
    include "../../include/auth.php";

    require_once('../config.php'); // Include the configuration file

    try {
    
    $sql = "SELECT 
            a.*,
            CONCAT(a.user_first_name, ' ', a.user_last_name) AS user_full_name,
            DATE_FORMAT(a.created_date, '%d-%b-%Y') AS formatted_date,
            CONCAT(b.user_first_name, ' ', b.user_last_name) AS created_by
            FROM 
                all_user_data a
            LEFT JOIN 
                all_user_data b ON a.created_by_id = b.user_id
            ";

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


