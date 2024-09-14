<?php
ob_start(); // Start output buffering

ini_set('log_errors', 1);
// ini_set('error_log', '../admin/php-error.log'); 
ini_set('error_log', '/tmp/php-error.log');
ini_set('display_errors', 1); // You can turn this off in production
error_reporting(E_ALL);

session_start(); // Ensure this is at the very top
echo $undefined_variablee;

// Database connection
require_once "../admin/db.php";

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
    echo "Password entered.<br>";
    error_log("Username entered: $input_username");
    error_log("Password entered.");

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

    $stmt->close();
}

// Ensure output buffering is flushed and output is sent
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
