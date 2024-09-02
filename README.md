# Protected Video Playback

This project demonstrates a simple implementation of protected video playback using PHP sessions and token-based access control. The solution ensures that only authorized users can access and view the video content.

## Project Structure

- `index.php`: The main page that generates a unique token and displays the video player.
  - Generates a unique token and stores it in a session.
  - Creates a protected video URL with the token as a query parameter.
  - Provides a video player in HTML with JavaScript to control playback and prevent right-click.

- `video.php`: The script that validates the token and serves the video file.
  - Checks the validity of the token and its expiration.
  - Verifies the referrer to ensure the request is authorized.
  - Outputs the video file for playback if all checks pass.

- `.htaccess`: Configuration file for access control and PHP version handling.
  - **Restricts Access**: Limits access to files in the `hiddenVideos` directory based on the referrer. Only requests where the referrer matches `https://yourdomain.com` are allowed. Requests from other referrers are denied.
  - **PHP Configuration**: Configures the PHP handler to use the default PHP version.

- `hiddenVideos/video.mp4`: The protected video file.
  - Place your video file here to be protected and accessed through the system.

## Usage

1. **Prepare the Video File**: Place the video file you want to protect in the `hiddenVideos/` directory.

2. **View the Video**: Access `index.php` via your web browser. This page will generate a unique token and display the video player.

3. **Playback Protection**: The video playback is protected by a token-based system. The `video.php` script ensures that only requests with a valid token can access the video file. Unauthorized access attempts will be denied.

## Configuration

- Ensure that the `.htaccess` file is properly configured on your server to enforce the referrer restrictions and set the PHP handler.
- **Referrer Restrictions**: Replace `https://yourdomain.com` with your actual domain to restrict access based on your referrer.
- Adjust the video path and token expiration time in `index.php` as needed to fit your requirements.

## License

This project is licensed under the GNU General Public License v3.0 (GPL-3.0) - see the [LICENSE](LICENSE) file for details.