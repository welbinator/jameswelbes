<!DOCTYPE html>
<html lang="en">
<?php 
ob_start();
ini_set('session.save_path', '/tmp');
session_start();

// Include database connection and functions
require_once "../db.php";
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
    <script src="https://cdn.tiny.cloud/1/7oc6yxpf300lo0d20iaoihqvz41lla6ceg6igx6r6vu6h3vj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#post_content',
            menubar: false,
            plugins: 'link image code lists',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code',
            content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }"
        });
    </script>

</head>

<body>
