<?php
ini_set('log_errors', 1);
ini_set('error_log', 'php-error.log');
ini_set('display_errors', 1);
error_reporting(E_ALL);


session_start();
require_once '../admin/db.php'; // Ensure this file connects to your database

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Form submitted.<br>";

    $input_username = htmlspecialchars(trim($_POST['username']));
    $input_password = htmlspecialchars(trim($_POST['password']));

    echo "Username: $input_username<br>";
    echo "Password: $input_password<br>";

    // Prepare a SQL statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        echo "Failed to prepare statement: " . $connection->error;
        exit();
    }

    $stmt->bind_param('s', $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided username exists
    if ($result->num_rows === 1) {
        echo "User found.<br>";
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($input_password, $user['password'])) {
            // Credentials are valid, log the user in
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username']; // Store the username in session
            echo "Login successful!<br>";
            header('Location: index.php'); // Redirect to admin area
            exit();
        } else {
            // Incorrect password
            echo "Invalid password.<br>";
        }
    } else {
        // Username doesn't exist
        echo "User not found.<br>";
    }

    $stmt->close();
}
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