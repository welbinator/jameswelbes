<?php
ini_set('session.save_path', '/tmp'); // Or a custom writable directory
session_start(); // Start the session

session_destroy(); 
echo  $_SESSION['loggedin'];
echo  $_SESSION['username'];
// header('Location: login.php'); // Redirect to login page
exit();
