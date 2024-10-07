<?php
ini_set('session.save_path', '/tmp');
session_start();
ob_start(); // Start output buffering

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
   

    // Log the POST data
   

    $input_username = htmlspecialchars(trim($_POST['username']));
    $input_password = htmlspecialchars(trim($_POST['password']));

   

    // Prepare a SQL statement to check the username
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        echo "Failed to prepare statement: " . $connection->error . "<br>";
        
        exit();
    }

    $stmt->bind_param('s', $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "Query executed.<br>";
   

    // Check if a user with the provided username exists
    if ($result->num_rows === 1) {
        
        $user = $result->fetch_assoc(); // Fetch the user data from the database
        
        

        // Verify the hashed password
        if (password_verify($input_password, $user['password'])) {
            

            // Credentials are valid, log the user in
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];

            

            header('Location: index.php'); // Redirect to admin area
            exit();
        } else {
            // Incorrect password
           
        }
    } else {
        // Username doesn't exist
        
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
