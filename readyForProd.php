<?php

/*
* Rename .htaccess to .htaccess.bak for backup
*/
$htaccessPath = __DIR__ . '/.htaccess.bak';
$backupPath = __DIR__ . '/.htaccess';

if (file_exists($htaccessPath)) {
    if (rename($htaccessPath, $backupPath)) {
        echo ".htaccess.bak has been renamed to .htaccess.\n";
    } else {
        echo "Failed to rename .htaccess.bak.\n";
    }
} else {
    echo ".htaccess.bak file does not exist.\n";
}

/*
* Update navigation for production
*/
$filePath = __DIR__ . '/includes/navigation.php';

// Read the content of the file
$fileContent = file_get_contents($filePath);

// Perform search and replace to revert changes
$searchReplacePairs = [
    '<a href="home.php">' => '<a href="home">',
    '<a href="bio.php">' => '<a href="bio">',
    '<a href="contact.php">' => '<a href="contact">',
    '<a href="webdesign.php">' => '<a href="webdesign">',
    // '<a href="blog.php">' => '<a href="blog">',
    '<a href="resume.php">' => '<a href="resume">',
];

foreach ($searchReplacePairs as $search => $replace) {
    $fileContent = str_replace($search, $replace, $fileContent);
}

// Write the modified content back to the file
file_put_contents($filePath, $fileContent);

/*
* update database for production
*/

// Define the path to the db.php file
$dbFilePath = __DIR__ . '/db.php';

// Read the content of the db.php file
$content = file_get_contents($dbFilePath);

// Define the search and replace strings
$searchString = "\$currentDbConfig = \$dbConfigs['devDB'];";
$replaceString = "\$currentDbConfig = \$dbConfigs['prodDB'];";

// Replace the development database configuration with the production configuration
$updatedContent = str_replace($searchString, $replaceString, $content);

// Write the updated content back to the db.php file
file_put_contents($dbFilePath, $updatedContent);

echo "Database configuration has been updated to production.\n";