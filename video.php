<?php
// Start the session to manage session variables
session_start();

// Validate the token and other parameters
if (
    !isset($_GET['token']) ||                           // Check if the token parameter is present
    !isset($_GET['file']) ||                            // Check if the file parameter is present
    $_GET['token'] !== $_SESSION['video_token'] ||      // Verify that the token matches the session token
    $_SESSION['video_token_expiration'] < time() ||     // Ensure that the token has not expired
    !isValidReferrer()                                  // Validate the referrer to ensure the request is from an authorized source
) {
    // If any validation fails, deny access
    die('Unauthorized access');
}

// Retrieve the video file path from the query parameters
$videoPath = $_GET['file'];

// Set the appropriate content type for the video file
header('Content-Type: video/mp4');

// Output the contents of the video file for playback
readfile($videoPath);

/**
 * Validate the referrer to ensure it matches the origin of the protected page
 * 
 * @return bool True if the referrer is valid, otherwise false
 */
function isValidReferrer() {
    // Get the referrer URL from the request headers
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

    // Get the origin of the protected HTML page (based on the current host)
    $protectedOrigin = getOriginFromURL($_SERVER['HTTP_HOST']);

    // Check if the referrer starts with the protected origin URL
    return startsWith($referrer, $protectedOrigin);
}

/**
 * Extract the origin (protocol, host, and optional port) from a URL
 * 
 * @param string $url The URL to parse
 * @return string The origin of the URL
 */
function getOriginFromURL($url) {
    // Parse the URL to get its components
    $parsedURL = parse_url($url);
    
    // Reconstruct the origin from the scheme, host, and port
    $scheme = isset($parsedURL['scheme']) ? $parsedURL['scheme'] . '://' : '';
    $host = isset($parsedURL['host']) ? $parsedURL['host'] : '';
    $port = isset($parsedURL['port']) ? ':' . $parsedURL['port'] : '';

    return $scheme . $host . $port;
}

/**
 * Check if a string starts with a specific substring
 * 
 * @param string $string The string to check
 * @param string $substring The substring to look for
 * @return bool True if the string starts with the substring, otherwise false
 */
function startsWith($string, $substring) {
    return substr($string, 0, strlen($substring)) === $substring;
}
?>
