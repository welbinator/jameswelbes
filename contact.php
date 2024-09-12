<?php
// Include header
require_once "includes/header.php";

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
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->isHTML(true);
            $mail->Username = getenv('MAIL_USERNAME'); // Use environment variables for credentials
            $mail->Password = getenv('MAIL_PASSWORD');
            $mail->SetFrom($post_from);
            $mail->Subject = $post_subject;
            $mail->Body = "<h3>From: $post_name</h3><br><p>Email: $post_from</p><br>$post_body";
            $mail->AddAddress('james.welbes@gmail.com');

            // Send the email
            $mail->send();

            // Auto-reply email
            $reply = new PHPMailer(true);
            $reply->isSMTP();
            $reply->SMTPAuth = true;
            $reply->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $reply->Host = 'smtp.gmail.com';
            $reply->Port = 465;
            $reply->isHTML(true);
            $reply->Username = getenv('MAIL_USERNAME');
            $reply->Password = getenv('MAIL_PASSWORD');
            $reply->SetFrom('james.welbes@gmail.com');
            $reply->Subject = 'Thank you for reaching out!';
            $reply->Body = '<p>Thank you for reaching out! I will get back to you shortly.</p>';
            $reply->AddAddress($post_from);

            // Send the reply email
            $reply->send();
        } catch (Exception $e) {
            // Handle exceptions
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Invalid form submission. Please make sure all fields are filled out correctly.";
    }
} else {
    // Handle CSRF token mismatch or invalid submission
    echo "Invalid request.";
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

                <div class="row form-group">
                  <div class="col-md-6 mb-3 mb-md-0">
                    <label class="text-white" for="fname">First Name</label>
                    <input type="text" name="name" id="fname" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label class="text-white" for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-md-12">
                    <label class="text-white" for="email">Email</label>
                    <input type="email" name="from" id="email" class="form-control" required>
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-md-12">
                    <label class="text-white" for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control" required>
                  </div>
                </div>

                <div class="row form-group mb-5">
                  <div class="col-md-12">
                    <label class="text-white" for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="7" class="form-control" required placeholder="Write your notes or questions here..."></textarea>
                  </div>
                </div>

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
