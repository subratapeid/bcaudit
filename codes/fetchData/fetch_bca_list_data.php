 <?php
    include "../../include/auth.php";

    require_once('../config.php');

    try {
    $sql = "SELECT 
    ab.*,
    CONCAT(
        ab.first_name, 
        CASE 
            WHEN ab.middle_name <> '' THEN CONCAT(' ', ab.middle_name) 
            ELSE '' 
        END,
        CASE 
            WHEN ab.middle_name <> '' AND ab.last_name <> '' THEN CONCAT(' ', ab.last_name) 
            ELSE CONCAT(' ', ab.last_name) 
        END
    ) AS bca_name,
    DATE_FORMAT(ab.created_date, '%d-%b-%Y') AS formatted_date,
    CONCAT(
        aud.user_first_name, 
        CASE 
            WHEN aud.user_last_name <> '' THEN CONCAT(' ', aud.user_last_name) 
            ELSE '' 
        END
    ) AS user_full_name
        FROM 
            all_bc_details ab
        JOIN 
            all_user_data aud 
        ON 
            ab.created_by_id = aud.user_id";


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


