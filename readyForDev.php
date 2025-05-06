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
* Update navigation and mobile menu for development
*/
$navFiles = [
    __DIR__ . '/includes/navigation.php',
    __DIR__ . '/includes/mobile-menu.php',
];

$searchReplacePairs = [
    '<a href="home">'      => '<a href="home.php">',
    '<a href="bio">'       => '<a href="bio.php">',
    '<a href="contact">'   => '<a href="contact.php">',
    '<a href="webdesign">' => '<a href="webdesign.php">',
    '<a href="blog">'      => '<a href="blog.php">',
    '<a href="resume">'    => '<a href="resume.php">',
];

foreach ($navFiles as $filePath) {
    if (file_exists($filePath)) {
        $fileContent = file_get_contents($filePath);
        foreach ($searchReplacePairs as $search => $replace) {
            $fileContent = str_replace($search, $replace, $fileContent);
        }
        file_put_contents($filePath, $fileContent);
        echo basename($filePath) . " links updated for development.\n";
    } else {
        echo basename($filePath) . " not found.\n";
    }
}

/*
* Update db for development
*/
$dbFilePath = __DIR__ . '/db.php';

if (file_exists($dbFilePath)) {
    $content = file_get_contents($dbFilePath);
    $searchString = "\$currentDbConfig = \$dbConfigs['prodDB'];";
    $replaceString = "\$currentDbConfig = \$dbConfigs['devDB'];";
    $updatedContent = str_replace($searchString, $replaceString, $content);
    file_put_contents($dbFilePath, $updatedContent);
    echo "Database configuration has been updated to development.\n";
} else {
    echo "db.php not found.\n";
}
