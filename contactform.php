<?php
if (isset($_REQUEST['submit'])) {
  if (
    empty($_REQUEST['name']) ||
    empty($_REQUEST['subject']) ||
    empty($_REQUEST['email']) ||
    empty($_REQUEST['message'])
  ) {
    $msg = '<div class="alert alert-warning col-12 text-center mt-3" role="alert">Please fill all fields!</div>';
  } else {
    $name = $_REQUEST['name'];
    $subject = $_REQUEST['subject'];
    $email = $_REQUEST['email'];
    $message = $_REQUEST['message'];

    $mailTo = "nnm22ad007@nmamit.in";
    $headers = "From: " . $email;
    $txt = "You have received an email from " . $name . ".\n\n" . $message;
    mail($mailTo, $subject, $txt, $headers);
    $msg = '<div class="alert alert-success col-12 text-center mt-3" role="alert">Message Sent Successfully!</div>';
  }
}
?>

<div class="contact-form-container mx-auto p-4 bg-white shadow rounded">
  <h3 class="text-center text-primary mb-4">Contact Us</h3>
  <form action="" method="post">
    <!-- Name Input -->
    <div class="form-group mb-3">
      <input type="text" class="form-control rounded-pill" name="name" placeholder="Your Name" required>
    </div>

    <!-- Subject Input -->
    <div class="form-group mb-3">
      <input type="text" class="form-control rounded-pill" name="subject" placeholder="Subject" required>
    </div>

    <!-- Email Input -->
    <div class="form-group mb-3">
      <input type="email" class="form-control rounded-pill" name="email" placeholder="Your Email" required>
    </div>

    <!-- Message Input -->
    <div class="form-group mb-4">
      <textarea class="form-control" name="message" placeholder="How can we help you?" style="height: 150px;" required></textarea>
    </div>

    <!-- Submit Button -->
    <div class="form-group text-center">
      <button class="btn btn-primary btn-lg rounded-pill px-5" type="submit" name="submit">Send Message</button>
    </div>

    <!-- Success or Error Message -->
    <?php if (isset($msg)) echo $msg; ?>
  </form>
</div>
