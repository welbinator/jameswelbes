<?php
// session_set_cookie_params([
//     'lifetime' => 0, // Session cookie lasts until the browser is closed
//     'path' => '/',
//     'domain' => 'jameswelbes.com', // Adjust to your actual domain
//     'secure' => isset($_SERVER['HTTPS']), // Use secure cookies if HTTPS is enabled
//     'httponly' => true, // Make cookie accessible only via HTTP (not JavaScript)
//     'samesite' => 'Strict' // Prevents sending cookies in cross-site requests
// ]);

// ini_set('session.save_path', __DIR__ . '/tmp'); 

session_start();



// Start output buffering
ob_start();


// Check if the user is logged in
session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header('Location: login.php');
//     exit();
// } else {
//     error_log("User is logged in: " . $_SESSION['username']);
   
// }


// Include database connection and functions
require_once "../admin/db.php";
require_once "functions.php";

// Autoload classes from the vendor directory
require '../vendor/autoload.php';

// Set headers for security
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
header("X-Content-Type-Options: nosniff"); // Prevent MIME-based attacks.
header("X-Frame-Options: SAMEORIGIN"); // Prevent clickjacking.
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload"); // Enforce HTTPS.
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shutter - Colorlib Website Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- TinyMCE Script -->
    <script src="https://cdn.tiny.cloud/1/7oc6yxpf300lo0d20iaoihqvz41lla6ceg6igx6r6vu6h3vj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
