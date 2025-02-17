<?php
include "../../include/auth.php";
require_once('../config.php');
header('Content-Type: application/json');

// Start session and get audit number
// session_start();
$auditNumber = $_SESSION['auditNumber'] ?? 'INT0013'; // Fallback value

try {
    // Fetch data from all tables
    $stmt = $pdo->prepare("
        SELECT 
            al.audit_number AS all_audit_number,
            DATE_FORMAT(al.created_date, '%d-%b-%Y at %h:%i %p') AS audit_date,
            ao.*,
            bbd.*,
            cv.*,
            hi.*,
            od.*,
            rm.*,
            tv.*
        FROM audit_list al
        LEFT JOIN auditor_observation ao ON al.audit_number = ao.audit_number
        LEFT JOIN bca_and_bcpoint_details bbd ON al.audit_number = bbd.audit_number
        LEFT JOIN compliance_verification cv ON al.audit_number = cv.audit_number
        LEFT JOIN hardware_infrastructure hi ON al.audit_number = hi.audit_number
        LEFT JOIN operational_details od ON al.audit_number = od.audit_number
        LEFT JOIN register_maintain rm ON al.audit_number = rm.audit_number
        LEFT JOIN transaction_verification tv ON al.audit_number = tv.audit_number
        WHERE al.audit_number = :auditNumber
    ");
    $stmt->execute(['auditNumber' => $auditNumber]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo json_encode(['success' => false, 'message' => 'No data found']);
        exit;
    }

    // Predefined answers mapping for Yes/No type questions
    $questionMapping = [
        1 => ['Yes' => 'Transactions are processed promptly.', 'No' => 'Transactions are not processed promptly.'],
        2 => ['Yes' => 'All transactions are accurately recorded.', 'No' => 'Transactions are not recorded accurately.'],
        3 => ['Yes' => 'Cash is handled securely and accurately.', 'No' => 'Cash handling has some security issues.'],
    ];

    // Extract values from fetched data
    $userAnswers = [
        // 1 => $row['proc_trans'] ?? 'Yes', // Example column
        // 2 => $row['proc_dep_with'] ?? 'No',
        // 3 => $row['delay_trans'] ?? 'Yes',
        4 => $row['groups_maintain'] ?? '123', // Example column for groups
        5 => $row['operating_hours'] ?? 'Operating hours are from 9 AM to 6 PM'
    ];

    // Function to generate the conclusion
    function generateConclusion($userAnswers, $questionMapping)
    {
        $conclusion = '';
        foreach ($userAnswers as $questionId => $answer) {
            if (isset($questionMapping[$questionId][$answer])) {
                $conclusion .= $questionMapping[$questionId][$answer] . " ";
            } else {
                switch ($questionId) {
                    case 4:
                        $conclusion .= "The Number of groups maintained by BCA is $answer. ";
                        break;
                    case 5:
                        $conclusion .= "The Operating Hours of BCA Point is $answer. ";
                        break;
                    default:
                        $conclusion .= "For question ID $questionId, the answer is: '$answer'. ";
                        break;
                }
            }
        }
        return $conclusion;
    }

    // Generate conclusion
    $conclusion = generateConclusion($userAnswers, $questionMapping);

    // Prepare response
    $response = [
        'success' => true,
        'data' => $row,
        'conclusion' => $conclusion
    ];

    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

unset($pdo);
?>