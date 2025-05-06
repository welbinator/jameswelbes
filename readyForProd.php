<?php

/*
* Rename .htaccess.bak to .htaccess for production
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
* Update navigation and mobile menu links for production
*/
$navFiles = [
    __DIR__ . '/includes/navigation.php',
    __DIR__ . '/includes/mobile-menu.php',
];

$searchReplacePairs = [
    '<a href="home.php">'    => '<a href="home">',
    '<a href="bio.php">'     => '<a href="bio">',
    '<a href="contact.php">' => '<a href="contact">',
    '<a href="webdesign.php">' => '<a href="webdesign">',
    '<a href="blog.php">'    => '<a href="blog">',
    '<a href="resume.php">'  => '<a href="resume">',
];

foreach ($navFiles as $filePath) {
    if (file_exists($filePath)) {
        $fileContent = file_get_contents($filePath);
        foreach ($searchReplacePairs as $search => $replace) {
            $fileContent = str_replace($search, $replace, $fileContent);
        }
        file_put_contents($filePath, $fileContent);
        echo basename($filePath) . " links updated for production.\n";
    } else {
        echo basename($filePath) . " not found.\n";
    }
}

/*
* Update database configuration to production
*/
$dbFilePath = __DIR__ . '/db.php';
if (file_exists($dbFilePath)) {
    $content = file_get_contents($dbFilePath);
    $searchString = "\$currentDbConfig = \$dbConfigs['devDB'];";
    $replaceString = "\$currentDbConfig = \$dbConfigs['prodDB'];";
    $updatedContent = str_replace($searchString, $replaceString, $content);
    file_put_contents($dbFilePath, $updatedContent);
    echo "Database configuration has been updated to production.\n";
} else {
    echo "db.php not found.\n";
}
