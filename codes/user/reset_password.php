<?php
include "../../include/auth.php";

// Include database connection file
include "../config.php";

// Check if the user ID is provided in the request
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Query the database to fetch user details based on the user ID
    $query = "SELECT * FROM all_user_data WHERE user_id = ?";
    
    // Prepare the statement
    $stmt = $pdo->prepare($query);
    
    // Bind the parameter
    $stmt->bindParam(1, $userId);
    
    // Execute the query
    if ($stmt->execute()) {
        // Fetch user details
        $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
        $userEmail= $userDetails['email_id'];
        $fullName = $userDetails['user_first_name'] . ' ' . $userDetails['user_last_name'];

        if ($userDetails) {
            // Generate a new password
            $newPassword = generateRandomPassword();
            
            // Update the password in the database
            $updateQuery = "UPDATE all_user_data SET password = ?, password_status = ? WHERE user_id = ?";
            $updateStmt = $pdo->prepare($updateQuery);
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $passwordStatus = "reset";
            $updateStmt->execute([$hashedPassword, $passwordStatus, $userId]);

            // Notify the user about the password reset 
            $notificationMessage = "Your password has been reset. Your new password is: $newPassword";
            // send an email to the user with the new password
            
            // Return a success message
            echo json_encode(array('success' => true, 'message' => 'Password reset successful.', 'newPassword' => $newPassword , 'email' => $userEmail, 'name' => $fullName));
        } else {
            // Handle case when user ID does not exist
            echo json_encode(array('success' => false, 'message' => 'User not found.'));
        }
    } else {
        // Handle database error
        http_response_code(500);
        echo json_encode(array('success' => false, 'message' => 'Database error'));
    }
} else {
    // Handle case when user ID is not provided
    http_response_code(400);
    echo json_encode(array('success' => false, 'message' => 'User ID not provided'));
}

// Function to generate a random password
function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}
?>
