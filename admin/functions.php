<?php
/**
 * Escapes a string for use in a MySQL query.
 * Also trims whitespace and adds additional protection against XSS.
 *
 * @param string $string The string to escape.
 * @return string The escaped and sanitized string.
 */
function escape($string) {
    global $connection;
    
    // First trim the string, then escape it for SQL, and finally escape for HTML to prevent XSS
    return htmlspecialchars(mysqli_real_escape_string($connection, trim($string)), ENT_QUOTES, 'UTF-8');
}

/**
 * Confirms that a MySQL query was successful.
 * Dies and outputs the error if the query fails.
 *
 * @param mysqli_result|bool $result The result of the MySQL query.
 */
function confirm($result) {
    global $connection;

    if (!$result) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }
}

/**
 * Compresses an image to reduce file size.
 *
 * @param string $source_url The source file path.
 * @param string $destination_url The destination file path.
 * @param int $quality The quality level of the output image (1-100).
 * @return string The destination file path.
 */
function compress_image($source_url, $destination_url, $quality) {
    // Get image information
    $info = getimagesize($source_url);

    if (!$info) {
        return "Invalid image file.";
    }

    // Determine the image type and create a new image resource
    switch ($info['mime']) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source_url);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source_url);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source_url);
            break;
        default:
            return "Unsupported image type.";
    }

    // Compress and save the image as a JPEG
    if (imagejpeg($image, $destination_url, $quality)) {
        return $destination_url;
    } else {
        return "Image compression failed.";
    }
}

?>
