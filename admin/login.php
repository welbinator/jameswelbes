<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'admin/db.php'; // Your database connection file
?>
<?php
session_start();
require_once "../admin/db.php";

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = htmlspecialchars(trim($_POST['username']));
    $input_password = htmlspecialchars(trim($_POST['password']));

    // Prepare a SQL statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided username exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($input_password, $user['password'])) {
            // Credentials are valid, log the user in
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username']; // Store the username in session
            header('Location: index.php'); // Redirect to admin area
            exit();
        } else {
            // Incorrect password
            $error = 'Invalid credentials';
        }
    } else {
        // Username doesn't exist
        $error = 'Invalid credentials';
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
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
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
