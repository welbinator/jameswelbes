<?php

// Database configurations
$dbConfigs = [
    'prodDB' => [
        'db_name' => 'jameswel_8js8dj98d',
        'db_user' => 'jameswelbes_portfolio',
        'db_pass' => 'h~Sv+0J9&HNN',
        'db_host' => '67.225.162.139',
    ],
    'devDB' => [
        'db_name' => 'jameswel_8js8dj98d',
        'db_user' => 'jameswelbes_portfolio',
        'db_pass' => 'h~Sv+0J9&HNN',
        'db_host' => 'localhost',
    ]
];

// Toggle between 'prodDB' and 'devDB' based on your current environment
// This line will be modified by your readyForDev or readyForProd scripts
$currentDbConfig = $dbConfigs['prodDB']; // Default to devDB

// Extracting the selected database configuration
extract($currentDbConfig);

// Define constants for database parameters
define('DB_NAME', $db_name);
define('DB_USER', $db_user);
define('DB_PASS', $db_pass);
define('DB_HOST', $db_host);

// Establish the database connection
$connection = new mysqli('localhost', 'db_user', 'db_password', 'db_name');
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
echo "DB connection successful.<br>";
error_log("DB connection successful.");


