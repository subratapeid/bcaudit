<?php
include "../../include/auth.php";

include '../config.php';
header('Content-Type: application/json');

$auditors = [];
$stmt = $pdo->prepare("SELECT CONCAT(user_first_name,' ', user_last_name) as name, emp_id as empId FROM all_user_data
WHERE user_role = 'auditor'");
$stmt->execute();
$auditors = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the data as JSON
echo json_encode($auditors);
?>
