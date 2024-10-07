<?php
ini_set('session.save_path', '/tmp'); // Or a custom writable directory
session_start(); // Start the session

session_destroy(); // Destroy all session data
header('Location: login.php'); // Redirect to login page
exit();
