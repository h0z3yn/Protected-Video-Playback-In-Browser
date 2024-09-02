<?php
// Start the session to manage session variables
session_start();

// Generate a unique token for securing video access
$token = bin2hex(random_bytes(16));

// Set the token expiration time to 10 minutes from the current time
$tokenExpiration = time() + (10 * 60); // 10 minutes in seconds

// Store the generated token and its expiration time in the session
$_SESSION['video_token'] = $token;
$_SESSION['video_token_expiration'] = $tokenExpiration;

// Define the path to the video file that needs to be protected
$videoPath = 'hiddenVideos/video.mp4';

// Generate a URL for accessing the video with the token and file path as query parameters
$protectedVideoUrl = 'video.php?token=' . urlencode($token) . '&file=' . urlencode($videoPath);

?><!DOCTYPE html>
<html>
<head>
    <title>Protected Video Playback</title>
</head>
<body>
    <!-- Video element to play the protected video -->
    <video id="myVideo" controls controlsList="nodownload">
        <!-- Set the source of the video to the protected URL -->
        <source src="<?php echo $protectedVideoUrl; ?>" type="video/mp4">
    </video>
    
    <script>
        // Get the video element by its ID
        const video = document.getElementById('myVideo');
      
        // Prevent the context menu from appearing on right-click
        video.addEventListener('contextmenu', (event) => {
            event.preventDefault();
        });
          
        // Toggle play/pause when the video is clicked
        video.addEventListener('click', () => {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        });
    </script>
</body>
</html>
