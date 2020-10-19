<?php

require('db-conn.inc.php');
require('phpMailer/PHPMailer.php');
require('phpMailer/Exception.php');
require('phpMailer/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Place this inside the bootstrap container to keep the right structure of the bootstrap document.
function phpShowFeedback($feedback_id) {
  switch ($feedback_id) {
    case "801":
      $feedback_type = "danger";
      $feedback_text = "This is not a valid email address!";
    break;

    case "802":
      $feedback_type = "danger";
      $feedback_text = "Password must be between 8 and 16 characters long, with at least one UPPERCASE and one lowercase character, one number and one special character (@, *, $ or #)!";
    break;

    case "803":
      $feedback_type = "danger";
      $feedback_text = "Passwords do not match!";
    break;

    case "804":
      $feedback_type = "danger";
      $feedback_text = "This email is already in use!";
    break;

    case "811":
      $feedback_type = "success";
      $feedback_text = "You have signed up successfully!";
    break;

    case "812":
      $feedback_type = "warning";
      $feedback_text = "Please check your inbox and click the verify link in the email I have just sent to you!";
    break;

    default:
      $feedback_type = "danger";
      $feedback_text = "Unspecified error or warning!";
    break;
  }

  return '<div class="row"><div class="col-12"><div class="alert alert-' . $feedback_type . '" role="alert">' . $feedback_text . '</div></div></div>';
}

// Create, Update and Delete a record in the database
function phpModifyDB($db_query, $db_data) {
  global $connection;

  $statement = $connection->prepare($db_query);
  $statement->execute($db_data);
}

// Get information from the database
function phpFetchDB($db_query, $db_data) {
  global $connection;

  $statement = $connection->prepare($db_query);
  $statement->execute($db_data);

  // Setting the fetch mode and returning the result
  return $statement->fetch(PDO::FETCH_ASSOC);
}

function phpSendEmail($to, $subject, $content) {
  // Create a ne PHPMailer instance
  $mail = new PHPMailer;
  // Tell PHPMailer to use SMTP
  $mail->isSMTP();
  // Enable SMTP debugging
  // 0 = Off for production use
  // 1 = Client Messages
  // 2 = Client and server message
  $mail->SMTPDebug = 0;
  // Set the host name of the mail server
  $mail->Host = 'smtp.gmail.com';
  // Set the SMTP port number
  $mail->Port = 587;
  // Set the encryption system to use tls
  $mail->SMTPSecure = 'tls';
  // Should I use SMTP authentication
  $mail->SMTPAuth = true;
  // Username for SMTP Authentication - use full email address for gmail
  $mail->Username = USERNAME;
  // Password to use for SMTP Authentication - Your gmail password
  $mail->Password = SMTP_PSWD;
  // Set who the mail is to be sent from
  $mail->setFrom(SENDER, 'System Admin - No reply');
  // Set who the message is to be sent to...
  $mail->addAddress($to);
  // Set email format to HTML and add content
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body    = $content;
  // Send the message and check for errors
  if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    $_SESSION['msgid'] = "812";
  }
}