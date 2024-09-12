<?php
// Start output buffering
ob_start();

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header('Location: login.php');
    exit();
}

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
<?php


// Admin username and password
$username = 'james';
$password = 'Isaiah117!@';

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the admin credentials into the database
$query = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $connection->prepare($query);
$stmt->bind_param('ss', $username, $hashed_password);

if ($stmt->execute()) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
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
