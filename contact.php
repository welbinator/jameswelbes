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
    if (isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
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
              $mail->SMTPDebug = 2;
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
              $mail->Host = getenv('MAIL_HOST');
              $mail->Port = 587;
              $mail->isHTML(true);
              $mail->Username = getenv('MAIL_USERNAME');
              $mail->Password = getenv('MAIL_PASSWORD');
              echo 'MAIL_FROM: ' . getenv('MAIL_FROM');

              $mail->setFrom(getenv('MAIL_FROM'), getenv('MAIL_FROM_NAME'));

              $mail->Subject = $post_subject;
              $mail->Body = "<h3>From: $post_name</h3><br><p>Email: $post_from</p><br>$post_body";
              $mail->AddAddress('james.welbes@gmail.com');

              // Send the email
              $mail->send();

         

              //Auto-reply email
              // $reply = new PHPMailer(true);
              // $reply->isSMTP();
              // $reply->SMTPAuth = true;
              // $reply->SMTPSecure = 'ssl'; // or 'tls' based on your setup
              // $reply->Host = getenv('MAIL_HOST'); // Using Brevo's SMTP host
              // $reply->Port = 465; // or 587 for 'tls'
              // $reply->isHTML(true);
              // $reply->Username = getenv('MAIL_USERNAME');
              // $reply->Password = getenv('MAIL_PASSWORD');
              // $reply->setFrom(getenv('MAIL_FROM'), getenv('MAIL_FROM_NAME'));
              // $reply->Subject = 'Thank you for reaching out!';
              // $reply->Body = '<p>Thank you for reaching out! I will get back to you shortly.</p>';
              // $reply->addAddress($post_from); // User's email address from the form

              // Send the reply email
              // $reply->send();

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
                    <input type="text" name="name" id="fname" class="form-control" required value="James">
                  </div>
                  <div class="col-md-6">
                    <label class="text-white" for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control" value="Welbes">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-md-12">
                    <label class="text-white" for="email">Email</label>
                    <input type="email" name="from" id="email" class="form-control" required value="james.welbes@gmail.com">
                  </div>
                </div>

                <div class="row form-group">
                  <div class="col-md-12">
                    <label class="text-white" for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control" required value="test">
                  </div>
                </div>

                <div class="row form-group mb-5">
                  <div class="col-md-12">
                    <label class="text-white" for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="7" class="form-control" required placeholder="Write your notes or questions here...">Test</textarea>
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
