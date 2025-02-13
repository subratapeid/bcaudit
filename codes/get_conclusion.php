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
        'Yes' => 'Transactions are processed promptly.',
        'No' => 'Transactions are not processed promptly.',
    ],
    2 => [
        'Yes' => 'All transactions are accurately recorded.',
        'No' => 'Transactions are not recorded accurately.',
    ],
    3 => [
        'Yes' => 'Cash is handled securely and accurately.',
        'No' => 'Cash handling has some security issues.',
    ]
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
        $userAnswers[4] = $row['no_of_groups'];  // Replace with actual column for abe_name
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