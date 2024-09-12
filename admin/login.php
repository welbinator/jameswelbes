<?php
ini_set('log_errors', 1);
ini_set('error_log', '../admin/php-error.log'); // Use the correct path to your log file
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start output buffering
ob_start();

session_start(); // Start the session at the top
require_once "../admin/db.php";

// Check if the database connection is working
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "Database connection successful!<br>";
    error_log("Database connection successful.");
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Form submitted.<br>";
    error_log("Form submitted.");

    $input_username = htmlspecialchars(trim($_POST['username']));
    $input_password = htmlspecialchars(trim($_POST['password']));

    echo "Username: $input_username<br>";
    error_log("Username entered: $input_username");

    // Prepare a SQL statement to check the username
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        echo "Failed to prepare statement: " . $connection->error . "<br>";
        error_log("Failed to prepare statement: " . $connection->error);
        exit();
    }

    $stmt->bind_param('s', $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        echo "Failed to execute query: " . $stmt->error . "<br>";
        error_log("Failed to execute query: " . $stmt->error);
    } else {
        echo "Query executed.<br>";
        error_log("Query executed.");

        // Check if a user with the provided username exists
        if ($result->num_rows === 1) {
            echo "User found.<br>";
            error_log("User found.");
            $user = $result->fetch_assoc();

            // Verify the hashed password
            if (password_verify($input_password, $user['password'])) {
                // Credentials are valid, log the user in
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username']; // Store the username in session
                echo "Login successful!<br>";
                error_log("Login successful.");
                header('Location: index.php'); // Redirect to admin area
                ob_end_flush(); // Flush the output buffer
                exit();
            } else {
                // Incorrect password
                echo "Invalid password.<br>";
                error_log("Invalid password.");
            }
        } else {
            // Username doesn't exist
            echo "User not found.<br>";
            error_log("User not found.");
        }
    }

    $stmt->close();
}

// Flush the output buffer
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
