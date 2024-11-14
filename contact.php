<?php
// Include header
require_once "includes/header.php";

// Create a sessions folder in your project root, e.g., '/app/sessions'
if (!file_exists(__DIR__ . '/sessions')) {
    mkdir(__DIR__ . '/sessions', 0777, true);
}

// Set the session save path
session_save_path(__DIR__ . '/sessions');

// Start session for CSRF protection
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer dependencies
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    
    // Verify reCAPTCHA response
    $recaptchaSecret = '6Lf81H4qAAAAAJsN2iWDLCBqGkhYQs5blPK0t0Tq';  // Replace with your actual secret key
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (!$responseKeys['success']) {
        echo "Please complete the CAPTCHA.";
    } else {
        // Sanitize inputs
        $post_subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $post_body = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
        $post_from = filter_var($_POST['from'], FILTER_SANITIZE_EMAIL);
        $post_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

        // Validate inputs
        if (filter_var($post_from, FILTER_VALIDATE_EMAIL) && !empty($post_name) && !empty($post_subject) && !empty($post_body)) {
            try {
                // Setup PHPMailer
                $mail = new PHPMailer(true);
                $mail->SMTPOptions = [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ],
                ];
                
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Host = 'smtp-relay.brevo.com';
                $mail->Port = 587;
                $mail->isHTML(true);
                $mail->Username = 'james.welbes@gmail.com';
                $mail->Password = 'fnYJbNwtv3E5MFZS';
                $mail->setFrom('james@apexbranding.design');

                $mail->Subject = $post_subject;
                $mail->Body = "<h3>From: $post_name</h3><br><p>Email: $post_from</p><br>$post_body";
                $mail->AddAddress('james.welbes@gmail.com');

                // Send the email
                $mail->send();
            } catch (Exception $e) {
                // Handle exceptions
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Invalid form submission. Please make sure all fields are filled out correctly.";
        }
    }
}
?>

<div class="container-fluid contact">
  <div class="row justify-content-center">
    <div class="col-md-6 pt-4" data-aos="fade-up">
      <h2 id="contactH2" class="text-white mb-4 text-center" data-aos="fade-up">Contact Me</h2>
      <div class="row">
        <div class="col-md-12">
          <p class="mb-5">Thanks for checking out my humble website. Please feel free to reach out via this contact form, I'd love to connect!</p>
          <div class="row">
            <div class="col-md-12">
              <form action="" method="post" enctype="multipart/form-data">
                <!-- Hidden CSRF token -->
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

                <!-- Your other form fields here -->

                <div class="g-recaptcha" data-sitekey="6Lf81H4qAAAAAEmx1r8QXaSxDEXiEXqlZIkwZsN8"></div> <!-- reCAPTCHA widget -->

                <div class="row form-group">
                  <div class="col-md-12">
                    <input type="submit" value="Send Message" name="submit" class="btn">
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
// Include footer
require_once "includes/footer.php";
?>
