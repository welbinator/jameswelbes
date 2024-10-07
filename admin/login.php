<?php
session_start();
ob_start(); // Start output buffering
$hashed_password = password_hash('pepsidude', PASSWORD_BCRYPT);

ini_set('display_errors', 1);

// Database connection
require_once "../admin/db.php";
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "Database connection successful!<br>";
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<script>alert('Form submitted.');</script>";

    // Log the POST data
    echo "<script>alert('POST Data: " . json_encode($_POST) . "');</script>";
    echo "<script>alert('Username entered: " . $_POST['username'] . "');</script>";
    echo "<script>alert('Password entered.');</script>";

    $input_username = htmlspecialchars(trim($_POST['username']));
    $input_password = htmlspecialchars(trim($_POST['password']));

    echo "<script>alert('Username after sanitizing: $input_username');</script>";
    echo "<script>alert('Password entered after sanitizing: $input_password');</script>";

    // Prepare a SQL statement to check the username
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        echo "Failed to prepare statement: " . $connection->error . "<br>";
        echo "<script>alert('Failed to prepare statement: " . $connection->error . "');</script>";
        exit();
    }

    $stmt->bind_param('s', $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "Query executed.<br>";
    echo "<script>alert('Query executed.');</script>";

    // Check if a user with the provided username exists
    if ($result->num_rows === 1) {
        echo "<script>alert('User found.');</script>";
        $user = $result->fetch_assoc(); // Fetch the user data from the database
        
        echo "<script>alert('Stored Password Hash: " . $user['password'] . "');</script>";

        // Verify the hashed password
        if (password_verify($input_password, $user['password'])) {
            echo "<script>alert('Password verification successful!');</script>";

            // Credentials are valid, log the user in
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];

            echo "<script>alert('Login successful!\\nSession Logged in: " . $_SESSION['loggedin'] . "\\nUsername: " . $_SESSION['username'] . "');</script>";

            header('Location: index.php'); // Redirect to admin area
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Password verification failed. Invalid password.');</script>";
        }
    } else {
        // Username doesn't exist
        echo "<script>alert('User not found');</script>";
    }

    $stmt->close();
}

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
