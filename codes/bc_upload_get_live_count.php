<?php
include "../include/auth.php";

include 'config.php';

try {

    // Function to get the current count of records in the database
    function getCurrentRecordCount($pdo) {
        $query = "SELECT COUNT(*) as count FROM all_bc_details";
        $stmt = $pdo->query($query);

        if ($stmt) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['count'];
        } else {
            return 0;
        }
    }

    // Get and echo the live count
    $liveCount = getCurrentRecordCount($pdo);
    echo $liveCount;


} catch (PDOException $e) {
   echo ('Connection failed: ' . $e->getMessage());
}
unset($pdo);

?>

