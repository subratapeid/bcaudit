<?php

// Step 1: Start the session and get the audit_number from session
session_start();
$audit_number = isset($_SESSION['auditNumber']) ? $_SESSION['auditNumber'] : 'INT0013'; // Example audit_number

// Step 2: Database connection (replace with your actual DB credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bc_audit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: SQL query to join all the tables and fetch necessary data based on audit_number
$query = "
SELECT 
    *
FROM 
    operational_details t1
JOIN 
    hardware_infrastructure t2 ON t1.audit_number = t2.audit_number
JOIN 
    register_maintain t3 ON t1.audit_number = t3.audit_number
JOIN 
    compliance_verification t4 ON t1.audit_number = t4.audit_number
JOIN 
    transaction_verification t5 ON t1.audit_number = t5.audit_number
WHERE 
    t1.audit_number = '$audit_number'
";

$result = $conn->query($query);

// Step 4: Initialize predefined answers mapping for Yes/No type questions
$questionMapping = [
    1 => [
        'Yes' => 'Operations are conducted from the designated BCA Point.',
        'No' => 'Operations are not conducted from the designated BCA Point. (From other location)',
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
        'No' => 'All necessary posters are not displayed. (Outdated posters are displayed.)',
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


// Step 5: Function to generate conclusions based on answers
function generateConclusion($userAnswers, $questionMapping)
{
    $conclusion = '';

    foreach ($userAnswers as $questionId => $answer) {
        // If it's a predefined Yes/No question, use the mapping
        if (isset($questionMapping[$questionId])) {
            $conclusion .= $questionMapping[$questionId][$answer] . " ";
        } else {
            // For user-input questions, format the output nicely
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

// Step 6: Process the result if there are any rows returned
if ($result->num_rows > 0) {
    $userAnswers = [];
    while ($row = $result->fetch_assoc()) {
        // Map the fetched data from the row to userAnswers array.
        // Replace the column names with your actual database column names.
        $userAnswers[1] = $row['proc_trans']; // Replace with actual column for transactions
        $userAnswers[2] = $row['proc_dep_with'];  // Replace with actual column for transaction recording
        $userAnswers[3] = $row['delay_trans']; // Replace with actual column for cash handling
        $userAnswers[4] = $row['groups_maintain'];  // Replace with actual column for abe_name
        $userAnswers[5] = $row['operating_hours'];  // Replace with actual column for abm_name
        // You can add more mappings here if necessary
    }
} else {
    // Default simulated answers if no data is returned
    $userAnswers = [
        1 => 'Yes', // Default simulated answers
        2 => 'No',
        3 => 'Yes',
        4 => '5 groups',  // Default example input
        5 => 'Operating hours are from 9 AM to 6 PM', // Default example input
    ];
}

// Step 7: Generate the conclusion based on the answers
$conclusion = generateConclusion($userAnswers, $questionMapping);

// Step 8: Prepare the response in JSON format
$response = [
    'conclusion' => $conclusion,
];

// Step 9: Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();

?>