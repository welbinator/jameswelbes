<?php include "includes/header.php"; ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if (isset($_POST['submit'])) {


  $post_subject = $_POST['subject'];
  $post_body = $_POST['message'];
  $post_from = $_POST['from'];
  $post_name = $_POST['name'];



  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = '465';
  $mail->isHTML();
  $mail->Username = 'james.welbes@gmail.com';
  $mail->Password = 'Isaiah117!@';
  $mail->SetFrom($post_from);
  $mail->Subject = $post_subject;
  $mail->Body = '<h3> From: ' . $post_name . '</h3><br><p>' . $post_from . '</p><br>' . $post_body;
  $mail->AddAddress('james.welbes@gmail.com');
  $mail->Send();

  $reply = new PHPMailer();
  $reply->isSMTP();
  $reply->SMTPAuth = true;
  $reply->SMTPSecure = 'ssl';
  $reply->Host = 'smtp.gmail.com';
  $reply->Port = '465';
  $reply->isHTML();
  $reply->Username = 'james.welbes@gmail.com';
  $reply->Password = 'Isaiah117';
  $reply->SetFrom($post_from);
  $reply->Subject = $post_subject;
  $reply->Body = '<p>Thank you for reaching out!</p><p>I will get back to you shortly</p>';
  $reply->AddAddress($post_from);
  $reply->Send();
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



                <div class="row form-group">
                  <div class="col-md-6 mb-3 mb-md-0">
                    <label class="text-white" for="fname">First Name</label>
                    <input type="text" name="name" id="fname" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="text-white" for="lname">Last Name</label>
                    <input type="text" id="lname" class="form-control">
                  </div>
                </div>

                <div class="row form-group">

                  <div class="col-md-12">
                    <label class="text-white" for="email">Email</label>
                    <input type="email" name="from" id="email" class="form-control">
                  </div>
                </div>

                <div class="row form-group">

                  <div class="col-md-12">
                    <label class="text-white" for="subject">Subject</label>
                    <input type="subject" name="subject" id="subject" class="form-control">
                  </div>
                </div>

                <div class="row form-group mb-5">
                  <div class="col-md-12">
                    <label class="text-white" for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
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

<?php include "includes/footer.php"; ?>