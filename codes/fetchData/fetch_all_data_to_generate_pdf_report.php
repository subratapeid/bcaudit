<?php
include "../../include/auth.php";
require_once('../config.php');
header('Content-Type: application/json');

// Start session and get audit number
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
        'bc_point_place' => ['Yes' => 'BC Point Place is properly maintained.', 'No' => 'BC Point Place is not properly maintained.'],
        'bc_point_clean' => ['Yes' => 'BC Point Cleanliness is maintained.', 'No' => 'BC Point Cleanliness is not maintained.'],
        'posters_displayed' => ['Yes' => 'Posters are displayed properly.', 'No' => 'Posters are not displayed properly.'],
        'customer_alert_dos_donts' => ['Yes' => 'Customer Alert Dos and Don’ts are displayed.', 'No' => 'Customer Alert Dos and Don’ts are not displayed.'],
        'verification_certificate' => ['Yes' => 'Verification Certificate is available.', 'No' => 'Verification Certificate is not available.'],
        'unauthorized_individuals' => ['Yes' => 'Unauthorized individuals are not present.', 'No' => 'Unauthorized individuals are present.'],
        'id_card_usage' => ['Yes' => 'ID Card usage is strictly followed.', 'No' => 'ID Card usage is not strictly followed.'],
        'clone_fingerprint' => ['Yes' => 'No Clone Fingerprint issues.', 'No' => 'Clone Fingerprint issue exists.'],
        'manual_receipts' => ['Yes' => 'Manual Receipts are being issued.', 'No' => 'Manual Receipts are not being issued.'],
        'system_generated_receipts' => ['Yes' => 'System-Generated Receipts are being issued.', 'No' => 'System-Generated Receipts are not being issued.'],
        'customer_passbooks' => ['Yes' => 'Customer Passbooks are maintained properly.', 'No' => 'Customer Passbooks are not maintained properly.'],
        'transaction_slips' => ['Yes' => 'Transaction Slips are being provided.', 'No' => 'Transaction Slips are not being provided.'],
        'non_relevant_applications' => ['Yes' => 'Non-Relevant Applications are avoided.', 'No' => 'Non-Relevant Applications are being entertained.'],
        'blocked_accounts' => ['Yes' => 'Blocked Accounts are properly managed.', 'No' => 'Blocked Accounts are not managed properly.'],
        'laptop_desktop' => ['Yes' => 'Laptop/Desktop is available and functional.', 'No' => 'Laptop/Desktop is not available or functional.'],
        'printer' => ['Yes' => 'Printer is available and functional.', 'No' => 'Printer is not available or functional.'],
        'scanner' => ['Yes' => 'Scanner is available and functional.', 'No' => 'Scanner is not available or functional.'],
        'biometric' => ['Yes' => 'Biometric System is available and functional.', 'No' => 'Biometric System is not available or functional.'],
        'pos_terminal' => ['Yes' => 'POS Terminal is available and functional.', 'No' => 'POS Terminal is not available or functional.'],
        'internet_router' => ['Yes' => 'Internet Router is functional.', 'No' => 'Internet Router is not functional.'],
        'ups' => ['Yes' => 'UPS is functioning properly.', 'No' => 'UPS is not functioning properly.'],
        'cctv_camera' => ['Yes' => 'CCTV Cameras are functional.', 'No' => 'CCTV Cameras are not functional.'],
        'mobile_tablet' => ['Yes' => 'Mobile/Tablet devices are functional.', 'No' => 'Mobile/Tablet devices are not functional.'],
        'counting_machine' => ['Yes' => 'Counting Machine is functional.', 'No' => 'Counting Machine is not functional.'],
        'card_reader' => ['Yes' => 'Card Reader is functional.', 'No' => 'Card Reader is not functional.'],
        'external_hdd' => ['Yes' => 'External HDD is available and functional.', 'No' => 'External HDD is not available or functional.'],
        'photocopier' => ['Yes' => 'Photocopier is functional.', 'No' => 'Photocopier is not functional.'],
        'other_devices' => ['Yes' => 'Other Devices are functional.', 'No' => 'Other Devices are not functional.'],
        // 'operating_hours' => ['Yes' => 'Operating Hours are properly followed.', 'No' => 'Operating Hours are not followed properly.'],
        'designated_location' => ['Yes' => 'Designated Location is followed.', 'No' => 'Designated Location is not followed.'],
        'training_given' => ['Yes' => 'Training has been provided.', 'No' => 'Training has not been provided.'],
        'business_explore' => ['Yes' => 'Business Exploration is in progress.', 'No' => 'Business Exploration is not in progress.'],
        'target_set' => ['Yes' => 'Target is set clearly.', 'No' => 'Target is not set clearly.'],
        'target_documented' => ['Yes' => 'Target is documented.', 'No' => 'Target is not documented.'],
        'abe_support' => ['Yes' => 'ABE Support is provided.', 'No' => 'ABE Support is not provided.'],
        'bank_support' => ['Yes' => 'Bank Support is provided.', 'No' => 'Bank Support is not provided.'],
        'onboarding_fee_paid' => ['Yes' => 'Onboarding Fee is paid.', 'No' => 'Onboarding Fee is not paid.'],
        'fee_unclear' => ['Yes' => 'Fee Structure is clear.', 'No' => 'Fee Structure is unclear.'],
        'fees_documented' => ['Yes' => 'Fees are documented.', 'No' => 'Fees are not documented.'],
        'fee_payment_mode' => ['Yes' => 'Fee Payment Mode is clear.', 'No' => 'Fee Payment Mode is unclear.'],
        'rm_visit' => ['Yes' => 'RM Visit occurred.', 'No' => 'RM Visit did not occur.'],
        'abm_visit' => ['Yes' => 'ABM Visit occurred.', 'No' => 'ABM Visit did not occur.'],
        'abe_visit' => ['Yes' => 'ABE Visit occurred.', 'No' => 'ABE Visit did not occur.'],
        'bank_official_visit' => ['Yes' => 'Bank Official Visit occurred.', 'No' => 'Bank Official Visit did not occur.'],
        'bc_visit' => ['Yes' => 'BC Visit occurred.', 'No' => 'BC Visit did not occur.'],
        'transaction_register' => ['Yes' => 'Transaction Register is maintained.', 'No' => 'Transaction Register is not maintained.'],
        'account_opening_register' => ['Yes' => 'Account Opening Register is maintained.', 'No' => 'Account Opening Register is not maintained.'],
        'complaint_register' => ['Yes' => 'Complaint Register is maintained.', 'No' => 'Complaint Register is not maintained.'],
        'visitor_register' => ['Yes' => 'Visitor Register is maintained.', 'No' => 'Visitor Register is not maintained.'],
        'cash_register' => ['Yes' => 'Cash Register is maintained.', 'No' => 'Cash Register is not maintained.'],
        'audit_register' => ['Yes' => 'Audit Register is maintained.', 'No' => 'Audit Register is not maintained.'],
        'service_register' => ['Yes' => 'Service Register is maintained.', 'No' => 'Service Register is not maintained.'],
        'inventory_register' => ['Yes' => 'Inventory Register is maintained.', 'No' => 'Inventory Register is not maintained.'],
        'loan_register' => ['Yes' => 'Loan Register is maintained.', 'No' => 'Loan Register is not maintained.'],
        'customer_feedback_register' => ['Yes' => 'Customer Feedback Register is maintained.', 'No' => 'Customer Feedback Register is not maintained.'],
        'compliance_register' => ['Yes' => 'Compliance Register is maintained.', 'No' => 'Compliance Register is not maintained.'],
        'staff_attendance_register' => ['Yes' => 'Staff Attendance Register is maintained.', 'No' => 'Staff Attendance Register is not maintained.'],
        'training_register' => ['Yes' => 'Training Register is maintained.', 'No' => 'Training Register is not maintained.'],
        'shg_register' => ['Yes' => 'SHG Register is maintained.', 'No' => 'SHG Register is not maintained.'],
        'settlement_register' => ['Yes' => 'Settlement Register is maintained.', 'No' => 'Settlement Register is not maintained.'],
        'target_achievement_register' => ['Yes' => 'Target Achievement Register is maintained.', 'No' => 'Target Achievement Register is not maintained.'],
        'entries_accuracy' => ['Yes' => 'Entries Accuracy is maintained.', 'No' => 'Entries Accuracy is not maintained.'],
        'transaction_entries_reliability' => ['Yes' => 'Transaction Entries Reliability is maintained.', 'No' => 'Transaction Entries Reliability is not maintained.'],
        'txn_count_matching' => ['Yes' => 'Transaction Count Matching is maintained.', 'No' => 'Transaction Count Matching is not maintained.'],
        'additional_remarks_registers' => ['Yes' => 'Additional Remarks Registers are maintained.', 'No' => 'Additional Remarks Registers are not maintained.']
    ];

    // Extract values from database, ensuring empty values default properly
    function getValue($row, $column, $default = 'No')
    {
        return isset($row[$column]) && trim($row[$column]) !== '' ? $row[$column] : $default;
    }

    $userAnswers = [
        'bc_point_place' => getValue($row, 'bc_point_place', 'No'),
        'bc_point_clean' => getValue($row, 'bc_point_clean', 'No'),
        'posters_displayed' => getValue($row, 'posters_displayed', 'No'),
        'customer_alert_dos_donts' => getValue($row, 'customer_alert_dos_donts', 'No'),
        'verification_certificate' => getValue($row, 'verification_certificate', 'No'),
        'unauthorized_individuals' => getValue($row, 'unauthorized_individuals', 'No'),
        'id_card_usage' => getValue($row, 'id_card_usage', 'No'),
        'clone_fingerprint' => getValue($row, 'clone_fingerprint', 'No'),
        'manual_receipts' => getValue($row, 'manual_receipts', 'No'),
        'system_generated_receipts' => getValue($row, 'system_generated_receipts', 'No'),
        'customer_passbooks' => getValue($row, 'customer_passbooks', 'No'),
        'transaction_slips' => getValue($row, 'transaction_slips', 'No'),
        'non_relevant_applications' => getValue($row, 'non_relevant_applications', 'No'),
        'blocked_accounts' => getValue($row, 'blocked_accounts', 'No'),
        'laptop_desktop' => getValue($row, 'laptop_desktop', 'No'),
        'printer' => getValue($row, 'printer', 'No'),
        'scanner' => getValue($row, 'scanner', 'No'),
        'biometric' => getValue($row, 'biometric', 'No'),
        'pos_terminal' => getValue($row, 'pos_terminal', 'No'),
        'internet_router' => getValue($row, 'internet_router', 'No'),
        'ups' => getValue($row, 'ups', 'No'),
        'cctv_camera' => getValue($row, 'cctv_camera', 'No'),
        'mobile_tablet' => getValue($row, 'mobile_tablet', 'No'),
        'counting_machine' => getValue($row, 'counting_machine', 'No'),
        'card_reader' => getValue($row, 'card_reader', 'No'),
        'external_hdd' => getValue($row, 'external_hdd', 'No'),
        'photocopier' => getValue($row, 'photocopier', 'No'),
        'other_devices' => getValue($row, 'other_devices', 'No'),
        'operating_hours' => getValue($row, 'operating_hours', 'N/A'),
        'designated_location' => getValue($row, 'designated_location', 'No'),
        'training_given' => getValue($row, 'training_given', 'No'),
        'business_explore' => getValue($row, 'business_explore', 'No'),
        'target_set' => getValue($row, 'target_set', 'No'),
        'target_documented' => getValue($row, 'target_documented', 'No'),
        'abe_support' => getValue($row, 'abe_support', 'No'),
        'bank_support' => getValue($row, 'bank_support', 'No'),
        'onboarding_fee_paid' => getValue($row, 'onboarding_fee_paid', 'No'),
        'fee_unclear' => getValue($row, 'fee_unclear', 'No'),
        'fees_documented' => getValue($row, 'fees_documented', 'No'),
        'fee_payment_mode' => getValue($row, 'fee_payment_mode', 'No'),
        'rm_visit' => getValue($row, 'rm_visit', 'No'),
        'abm_visit' => getValue($row, 'abm_visit', 'No'),
        'abe_visit' => getValue($row, 'abe_visit', 'No'),
        'bank_official_visit' => getValue($row, 'bank_official_visit', 'No'),
        'bc_visit' => getValue($row, 'bc_visit', 'No'),
        'transaction_register' => getValue($row, 'transaction_register', 'No'),
        'account_opening_register' => getValue($row, 'account_opening_register', 'No'),
        'complaint_register' => getValue($row, 'complaint_register', 'No'),
        'visitor_register' => getValue($row, 'visitor_register', 'No'),
        'cash_register' => getValue($row, 'cash_register', 'No'),
        'audit_register' => getValue($row, 'audit_register', 'No'),
        'service_register' => getValue($row, 'service_register', 'No'),
        'inventory_register' => getValue($row, 'inventory_register', 'No'),
        'loan_register' => getValue($row, 'loan_register', 'No'),
        'customer_feedback_register' => getValue($row, 'customer_feedback_register', 'No'),
        'compliance_register' => getValue($row, 'compliance_register', 'No'),
        'staff_attendance_register' => getValue($row, 'staff_attendance_register', 'No'),
        'training_register' => getValue($row, 'training_register', 'No'),
        'shg_register' => getValue($row, 'shg_register', 'No'),
        'settlement_register' => getValue($row, 'settlement_register', 'No'),
        'target_achievement_register' => getValue($row, 'target_achievement_register', 'No'),
        'entries_accuracy' => getValue($row, 'entries_accuracy', 'No'),
        'transaction_entries_reliability' => getValue($row, 'transaction_entries_reliability', 'No'),
        'txn_count_matching' => getValue($row, 'txn_count_matching', 'No'),
        'additional_remarks_registers' => getValue($row, 'additional_remarks_registers', 'No'),
        'groups_maintain' => getValue($row, 'groups_maintain', 'N/A')
    ];


    // Function to generate the conclusion
    function generateConclusion($userAnswers, $questionMapping)
    {
        $conclusion = '';
        foreach ($userAnswers as $columnName => $answer) {
            if (isset($questionMapping[$columnName][$answer])) {
                $conclusion .= $questionMapping[$columnName][$answer] . " ";
            } else {
                switch ($columnName) {
                    case 'groups_maintain':
                        $conclusion .= "The Number of groups maintained by BCA is $answer. ";
                        break;
                    case 'operating_hours':
                        $conclusion .= "The Operating Hours of BCA Point is $answer. ";
                        break;
                    // You can add more cases as needed for additional column mappings
                }
            }
        }
        return trim($conclusion);
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