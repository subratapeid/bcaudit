<?php
// Function to fetch the current date and time based on local device time
function getDateTime() {
    // Create a DateTime object with the current time
    $currentTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

    // Format the date and time
    $formattedDateTime = $currentTime->format('Y-m-d H:i:s');

    // Return the formatted date and time
    return $formattedDateTime;
}

// Testing usage
// echo getDateTime();
?>
