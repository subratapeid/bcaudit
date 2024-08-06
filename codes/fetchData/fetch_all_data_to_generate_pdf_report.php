<?php
include "../../include/auth.php";
require_once('../config.php');
header('Content-Type: application/json');

// fetch_all_data_to_generate_pdf_report.php

$auditNumber = $_SESSION["auditNumber"];

try {
    // Fetch data
    $stmt = $pdo->prepare("SELECT 
    al.audit_number AS all_audit_number,
    DATE_FORMAT(al.created_date, '%d-%b-%Y at %h:%i %p') AS audit_date,
    ao.*,
    bbd.*,
    cv.*,
    hi.*,
    od.*,
    rm.*,
    tv.*
FROM
    audit_list al
LEFT JOIN
    auditor_observation ao ON al.audit_number = ao.audit_number
LEFT JOIN
    bca_and_bcpoint_details bbd ON al.audit_number = bbd.audit_number
LEFT JOIN
    compliance_verification cv ON al.audit_number = cv.audit_number
LEFT JOIN
    hardware_infrastructure hi ON al.audit_number = hi.audit_number
LEFT JOIN
    operational_details od ON al.audit_number = od.audit_number
LEFT JOIN
    register_maintain rm ON al.audit_number = rm.audit_number
LEFT JOIN
    transaction_verification tv ON al.audit_number = tv.audit_number
WHERE
    al.audit_number = :auditNumber");

    $stmt->execute(['auditNumber' => $auditNumber]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode(['success' => true, 'data' => $row]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No data found']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
unset($pdo);

// Function to convert database date to frontend format
function convertToFrontendFormat($dbDate) {
    $dateTime = new DateTime($dbDate);
    return $dateTime->format('d-M-Y, h:i A');
}

?>
