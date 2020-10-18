<?php

require('db-conn.inc.php');

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

    case "811":
      $feedback_type = "success";
      $feedback_text = "You have signed up successfully!";
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