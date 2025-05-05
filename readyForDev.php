<?php

/*
* Rename .htaccess to .htaccess.bak for backup
*/
$htaccessPath = __DIR__ . '/.htaccess';
$backupPath = __DIR__ . '/.htaccess.bak';

if (file_exists($htaccessPath)) {
    if (rename($htaccessPath, $backupPath)) {
        echo ".htaccess has been renamed to .htaccess.bak.\n";
    } else {
        echo "Failed to rename .htaccess.\n";
    }
} else {
    echo ".htaccess file does not exist.\n";
}

/*
* Update navigation for development
*/
$filePath = __DIR__ . '/includes/navigation.php';

// Read the content of the file
$fileContent = file_get_contents($filePath);

// Perform search and replace
$searchReplacePairs = [
    '<a href="home">' => '<a href="home.php">',
    '<a href="bio">' => '<a href="bio.php">',
    '<a href="contact">' => '<a href="contact.php">',
    '<a href="webdesign">' => '<a href="webdesign.php">',
    '<a href="ramblings">' => '<a href="ramblings.php">',
    '<a href="resume">' => '<a href="resume.php">',
];

foreach ($searchReplacePairs as $search => $replace) {
    $fileContent = str_replace($search, $replace, $fileContent);
}

// Write the modified content back to the file
file_put_contents($filePath, $fileContent);

/*
* Update db for development
*/

// Define the path to the db.php file
$dbFilePath = __DIR__ . '/db.php';

// Read the content of the db.php file
$content = file_get_contents($dbFilePath);

// Define the search and replace strings
$searchString = "\$currentDbConfig = \$dbConfigs['prodDB'];";
$replaceString = "\$currentDbConfig = \$dbConfigs['devDB'];";

// Replace the production database configuration with the development configuration
$updatedContent = str_replace($searchString, $replaceString, $content);

// Write the updated content back to the db.php file
file_put_contents($dbFilePath, $updatedContent);

echo "Database configuration has been updated to development.\n";
