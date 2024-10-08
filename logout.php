<?php
// Start the session
include "include/auth.php";

// Unset all of the session variables
$_SESSION = array();

// If the session was propagated using cookies, delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: user-login.php');
exit;

?>
