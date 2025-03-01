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
        1 => [
            'Yes' => 'Operations are conducted from the designated BCA Point.',
            'No' => 'Operations are not conducted from the designated BCA Point.',
        ],
        2 => [
            'Yes' => 'ABE provided training on Opportunity Chart, commissions, SSS camps, and other topics.',
            'No' => 'ABE did not provide training on Opportunity Chart, commissions, SSS camps, and other topics.',
        ],
        3 => [
            'Yes' => 'Targets were set and communicated to BCA.',
            'No' => 'Targets were not set and communicated to BCA.',
        ],
        4 => [
            'Yes' => 'BCA has a clear understanding of the targets.',
            'No' => 'BCA does not have a clear understanding of the targets.',
        ],
        5 => [
            'Yes' => 'Visits by ABE were documented and recorded.',
            'No' => 'Visits by ABE were not documented and recorded.',
        ],
        6 => [
            'Yes' => 'ABE supports all BCA operational activities.',
            'No' => 'ABE does not support all BCA operational activities.',
        ],
        7 => [
            'Yes' => 'Sufficient support was provided by the bank/ABE for transactions.',
            'No' => 'Sufficient support was not provided by the bank/ABE for transactions.',
        ],
        8 => [
            'Yes' => 'A fee was paid during onboarding for payment operations.',
            'No' => 'Any fee was not paid during onboarding for payment operations.',
        ],
        9 => [
            'Yes' => 'RM visited twice in the last month.',
            'No' => 'RM did not visit twice in the last month. (Visited 1 time)',
        ],
        10 => [
            'Yes' => 'ABE visited three times in the last month.',
            'No' => 'ABE did not visit three times in the last month.',
        ],
        11 => [
            'Yes' => 'Bank officials visited the BCA point.',
            'No' => 'Bank officials did not visit the BCA point.',
        ],
        12 => [
            'Yes' => 'BC makes frequent visits to the bank.',
            'No' => 'BC does not make frequent visits to the bank.',
        ],
        13 => [
            'Yes' => 'Laptop or Desktop Computer is present.',
            'No' => 'Laptop or Desktop Computer is not present.',
        ],
        14 => [
            'Yes' => 'Printer device is present.',
            'No' => 'Printer device is not present.',
        ],
        15 => [
            'Yes' => 'Scanner is present.',
            'No' => 'Scanner is not present.',
        ],
        16 => [
            'Yes' => 'Biometric Device (Fingerprint Scanner) is present.',
            'No' => 'Biometric Device (Fingerprint Scanner) is not present.',
        ],
        17 => [
            'Yes' => 'Internet Router/Modem is present.',
            'No' => 'Internet Router/Modem is not present.',
        ],
        18 => [
            'Yes' => 'UPS (Uninterruptible Power Supply) is present.',
            'No' => 'UPS (Uninterruptible Power Supply) is not present.',
        ],
        19 => [
            'Yes' => 'CCTV Camera is present.',
            'No' => 'CCTV Camera is not present. (Present but not working)',
        ],
        20 => [
            'Yes' => 'Mobile Phone or Tablet is present.',
            'No' => 'Mobile Phone or Tablet is not present.',
        ],
        21 => [
            'Yes' => 'Cash Counting Machine is present.',
            'No' => 'Cash Counting Machine is not present.',
        ],
        22 => [
            'Yes' => 'Card Reader is present.',
            'No' => 'Card Reader is not present.',
        ],
        23 => [
            'Yes' => 'External Hard Drive or USB Drive is present.',
            'No' => 'External Hard Drive or USB Drive is not present.',
        ],
        24 => [
            'Yes' => 'Photocopier is present.',
            'No' => 'Photocopier is not present.',
        ],
        25 => [
            'Yes' => 'Transaction Register is maintained.',
            'No' => 'Transaction Register is not maintained.',
        ],
        26 => [
            'Yes' => 'Account Opening Register is maintained.',
            'No' => 'Account Opening Register is not maintained.',
        ],
        27 => [
            'Yes' => 'Complaint Register is maintained.',
            'No' => 'Complaint Register is not maintained.',
        ],
        28 => [
            'Yes' => 'Visitor Register is maintained.',
            'No' => 'Visitor Register is not maintained.',
        ],
        29 => [
            'Yes' => 'Cash Register is maintained.',
            'No' => 'Cash Register is not maintained.',
        ],
        30 => [
            'Yes' => 'Audit Register is maintained.',
            'No' => 'Audit Register is not maintained.',
        ],
        31 => [
            'Yes' => 'Service Register is maintained.',
            'No' => 'Service Register is not maintained.',
        ],
        32 => [
            'Yes' => 'Inventory Register is maintained.',
            'No' => 'Inventory Register is not maintained.',
        ],
        33 => [
            'Yes' => 'Loan Register is maintained.',
            'No' => 'Loan Register is not maintained.',
        ],
        34 => [
            'Yes' => 'Customer Feedback Register is maintained.',
            'No' => 'Customer Feedback Register is not maintained.',
        ],
        35 => [
            'Yes' => 'Compliance Register is maintained.',
            'No' => 'Compliance Register is not maintained.',
        ],
        36 => [
            'Yes' => 'Staff Attendance Register is maintained.',
            'No' => 'Staff Attendance Register is not maintained.',
        ],
        37 => [
            'Yes' => 'Training Register is maintained.',
            'No' => 'Training Register is not maintained.',
        ],
        38 => [
            'Yes' => 'SHG (Self Help Group) Register is maintained.',
            'No' => 'SHG (Self Help Group) Register is not maintained.',
        ],
        39 => [
            'Yes' => 'Settlement Register is maintained.',
            'No' => 'Settlement Register is not maintained.',
        ],
        40 => [
            'Yes' => 'Target Achievement Register is maintained.',
            'No' => 'Target Achievement Register is not maintained.',
        ],
        41 => [
            'Yes' => 'Transaction registers contain correct entries.',
            'No' => 'Transaction registers contain incorrect entries.',
        ],
        42 => [
            'Yes' => 'Registers match with the settlement account entry.',
            'No' => 'Registers do not match with the settlement account entry.',
        ],
        43 => [
            'Yes' => 'BC Point is located in a prominent place.',
            'No' => 'BC Point is not located in a prominent place.',
        ],
        44 => [
            'Yes' => 'BC Point is clean and well-maintained.',
            'No' => 'BC Point is not clean and well-maintained.',
        ],
        45 => [
            'Yes' => 'All necessary posters are displayed.',
            'No' => 'All necessary posters are not displayed.',
        ],
        46 => [
            'Yes' => 'Dos and Don’ts for Customer Alert before Transactions are displayed.',
            'No' => 'Dos and Don’ts for Customer Alert before Transactions are not displayed.',
        ],
        47 => [
            'Yes' => 'IIBF, DSA, police verification certificate is present.',
            'No' => 'IIBF, DSA, police verification certificate is not present.',
        ],
        48 => [
            'Yes' => 'BCA is using a valid ID card issued by the company.',
            'No' => 'BCA is not using a valid ID card issued by the company.',
        ],
        49 => [
            'Yes' => 'Only system-generated transaction receipts are issued.',
            'No' => 'Manual handwritten receipts were issued.',
        ],
        50 => [
            'Yes' => 'Customer transaction slips are handed over to the customer.',
            'No' => 'Customer transaction slips are not handed over to the customer.',
        ],
        51 => [
            'Yes' => 'Transactions are processed promptly.',
            'No' => 'Transactions are not processed promptly.',
        ],
        52 => [
            'Yes' => 'Deposits and withdrawals are processed promptly.',
            'No' => 'Deposits and withdrawals are not processed promptly.',
        ],
        53 => [
            'Yes' => 'All transactions are accurately recorded in the system.',
            'No' => 'All transactions are not accurately recorded in the system.',
        ],
        54 => [
            'Yes' => 'Timestamps on transaction slips match the actual transaction times.',
            'No' => 'Timestamps on transaction slips do not match the actual transaction times.',
        ],
        55 => [
            'Yes' => 'Proper customer verification is conducted before processing transactions.',
            'No' => 'Proper customer verification is not conducted before processing transactions.',
        ],
        56 => [
            'Yes' => 'Customer OTPs, biometric data, or PINs are used for verifying transactions.',
            'No' => 'Customer OTPs, biometric data, or PINs are not used for verifying transactions.',
        ],
        57 => [
            'Yes' => 'System-generated receipts are issued for each transaction.',
            'No' => 'System-generated receipts are not issued for each transaction.',
        ],
        58 => [
            'Yes' => 'Customers are provided with a copy of the transaction slip.',
            'No' => 'Customers are not provided with a copy of the transaction slip.',
        ],
        59 => [
            'Yes' => 'Deposit and withdrawal transactions are within the prescribed limits.',
            'No' => 'Deposit and withdrawal transactions are not within the prescribed limits.',
        ],
        60 => [
            'Yes' => 'Transactions exceeding the limits are properly authorized and documented.',
            'No' => 'Transactions exceeding the limits are not properly authorized and documented.',
        ],
        61 => [
            'Yes' => 'Cash is handled securely and accurately.',
            'No' => 'Cash is not handled securely and accurately.',
        ],
        62 => [
            'Yes' => 'Deposit and withdrawal procedures comply with the bank’s policies.',
            'No' => 'Deposit and withdrawal procedures do not comply with the bank’s policies.',
        ],
        63 => [
            'Yes' => 'Regulatory requirements are adhered to during transactions.',
            'No' => 'Regulatory requirements are not adhered to during transactions.',
        ],
        64 => [
            'Yes' => 'There is a clear audit trail for each deposit and withdrawal.',
            'No' => 'There is no clear audit trail for each deposit and withdrawal.',
        ],
        65 => [
            'Yes' => 'Transaction details are clearly communicated to customers.',
            'No' => 'Transaction details are not clearly communicated to customers.',
        ],
        66 => [
            'Yes' => 'There were no technical issues affecting transaction processing.',
            'No' => 'There were technical issues affecting transaction processing.',
        ],
    ];
    // Extract values from database, ensuring empty values default properly
    function getValue($row, $column, $default = 'No')
    {
        return isset($row[$column]) && trim($row[$column]) !== '' ? $row[$column] : $default;
    }

    $userAnswers = [
        1  => getValue($row, 'bc_point_place', 'No'),
        2  => getValue($row, 'training_given', 'No'),
        3  => getValue($row, 'targets_set', 'No'),
        4  => getValue($row, 'bca_understanding_targets', 'No'),
        5  => getValue($row, 'abe_visits_recorded', 'No'),
        6  => getValue($row, 'abe_support_operations', 'No'),
        7  => getValue($row, 'sufficient_support', 'No'),
        8  => getValue($row, 'onboarding_fee_paid', 'No'),
        9  => getValue($row, 'rm_visits_last_month', 'No'),
        10 => getValue($row, 'abe_visits_last_month', 'No'),
        11 => getValue($row, 'bank_officials_visited', 'No'),
        12 => getValue($row, 'bca_feedback_taken', 'No'),
        13 => getValue($row, 'customer_transactions_easy', 'No'),
        14 => getValue($row, 'device_functional', 'No'),
        15 => getValue($row, 'no_network_issues', 'No'),
        16 => getValue($row, 'system_speed_good', 'No'),
        17 => getValue($row, 'transactions_completed_successfully', 'No'),
        18 => getValue($row, 'cash_availability_good', 'No'),
        19 => getValue($row, 'atm_withdrawal_supported', 'No'),
        20 => getValue($row, 'adequate_security', 'No'),
        21 => getValue($row, 'insurance_services_available', 'No'),
        22 => getValue($row, 'loan_services_available', 'No'),
        23 => getValue($row, 'customer_satisfaction_high', 'No'),
        24 => getValue($row, 'no_pending_complaints', 'No'),
        25 => getValue($row, 'bc_point_cleanliness', 'No'),
        26 => getValue($row, 'power_backup_available', 'No'),
        27 => getValue($row, 'bca_uniform_wearing', 'No'),
        28 => getValue($row, 'bca_id_card_visible', 'No'),
        29 => getValue($row, 'customer_grievance_mechanism', 'No'),
        30 => getValue($row, 'printed_transaction_slip_given', 'No'),
        31 => getValue($row, 'biometric_device_functional', 'No'),
        32 => getValue($row, 'printer_functional', 'No'),
        33 => getValue($row, 'pos_machine_available', 'No'),
        34 => getValue($row, 'adequate_cash_handling', 'No'),
        35 => getValue($row, 'customer_kiosk_functional', 'No'),
        36 => getValue($row, 'bca_customer_knowledge_tested', 'No'),
        37 => getValue($row, 'loan_disbursement_smooth', 'No'),
        38 => getValue($row, 'insurance_claim_process_smooth', 'No'),
        39 => getValue($row, 'kyc_procedure_followed', 'No'),
        40 => getValue($row, 'fake_currency_detection_mechanism', 'No'),
        41 => getValue($row, 'bank_related_display_material_visible', 'No'),
        42 => getValue($row, 'hand_holding_support_available', 'No'),
        43 => getValue($row, 'cash_deposit_process_smooth', 'No'),
        44 => getValue($row, 'cash_withdrawal_process_smooth', 'No'),
        45 => getValue($row, 'remittance_services_available', 'No'),
        46 => getValue($row, 'digital_payment_options_available', 'No'),
        47 => getValue($row, 'customer_feedback_register_available', 'No'),
        48 => getValue($row, 'bca_aware_of_fraud_prevention', 'No'),
        49 => getValue($row, 'bca_aware_of_compliance_guidelines', 'No'),
        50 => getValue($row, 'bca_has_passbook_update_facility', 'No'),
        51 => getValue($row, 'bca_performing_outreach_activities', 'No'),
        52 => getValue($row, 'financial_literacy_sessions_conducted', 'No'),
        53 => getValue($row, 'bca_receiving_timely_commissions', 'No'),
        54 => getValue($row, 'bca_facing_payment_issues', 'No'),
        55 => getValue($row, 'bca_accessing_portal_for_data', 'No'),
        56 => getValue($row, 'bca_providing_doorstep_banking', 'No'),
        57 => getValue($row, 'bca_equipped_with_smartphone', 'No'),
        58 => getValue($row, 'bca_using_bank_mobile_app', 'No'),
        59 => getValue($row, 'bca_aware_of_cybersecurity', 'No'),
        60 => getValue($row, 'bca_has_sufficient_training_material', 'No'),
        61 => getValue($row, 'bank_employee_responsive_to_issues', 'No'),
        62 => getValue($row, 'customer_gathering_in_bc_point', 'No'),
        63 => getValue($row, 'bca_willing_to_continue_services', 'No'),
        64 => getValue($row, 'bca_has_sufficient_digital_marketing', 'No'),
        65 => getValue($row, 'customer_engagement_activities_done', 'No'),
        66 => getValue($row, 'bca_participating_in_bank_meetings', 'No'),
        'operating_hours' => getValue($row, 'operating_hours', 'N/A'),

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