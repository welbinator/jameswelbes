<?php
// Start the session
session_start();





if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
} else {
    error_log("User is logged in: " . $_SESSION['username']);
    // Proceed with the page content
}


// Include database connection and functions
require_once "../admin/db.php";
require_once "functions.php";

// Autoload classes from the vendor directory
// require '../vendor/autoload.php';

// Set headers for security
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
header("X-Content-Type-Options: nosniff"); // Prevent MIME-based attacks.
header("X-Frame-Options: SAMEORIGIN"); // Prevent clickjacking.
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload"); // Enforce HTTPS.


// Start output buffering
ob_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <!-- <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->

    <!-- TinyMCE Script -->
    <script src="https://cdn.tiny.cloud/1/7oc6yxpf300lo0d20iaoihqvz41lla6ceg6igx6r6vu6h3vj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
