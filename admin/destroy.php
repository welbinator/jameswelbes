<?php
ini_set('session.save_path', '/tmp'); // Or a custom writable directory
session_start(); // Start the session

// Destroy all session data
session_destroy(); 

// Clear the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
echo  $_SESSION['loggedin'];
echo  $_SESSION['username'];
header('Location: login.php'); // Redirect to login page
exit();
