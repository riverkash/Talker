<?php
  session_start();
  require('system.ctrl.php');

  // echo $_POST["formSignUpEmail"];
  // echo $_POST["formSignUpPassword"];
  // echo $_POST["user_password"];

  $user_email = $_POST["formSignUpEmail"];
  $user_email_pattern = "~^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$~";

  $user_password = $_POST["formSignUpPassword"];
  $user_password_pattern = "~(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@*$#]).{8,16}~";

  $email_validation = preg_match($user_email_pattern, $user_email);
  $password_validation = preg_match($user_password_pattern, $user_password);

  if ($email_validation && $password_validation && $user_password == $_POST["formSignUpPasswordConf"]) {
    // Hash the password before storing it in the database
    $hashed_user_password = password_hash($user_password, PASSWORD_DEFAULT);

    $db_data = array($user_email);
    $isAlreadySignedUp = phpFetchDB('SELECT user_email FROM users WHERE user_email = ?', $db_data);
    $db_data = "";

    // If no result returned enter the details into the database, otherwise show feedback
    if (!is_array($isAlreadySignedUp)) {
      $db_data = array($user_email, $hashed_user_password);
      phpModifyDB('INSERT INTO users (user_email, user_password) VALUES (?, ?)', $db_data);
      $db_data = "";
      $_SESSION["msgid"] = "811";
    } else {
      $_SESSION["msgid"] = "804";
    }
    header('Location: index.php');
  }elseif (!$email_validation) {
    $_SESSION["msgid"] = "801";
    header('Location: index.php');
  }elseif(!$password_validation) {
    $_SESSION["msgid"] = "802";
    header('Location: index.php');
  }elseif ($user_password != $_POST["formSignUpPasswordConf"]) {
    $_SESSION["msgid"] = "803";
    header('Location: index.php');
  }
?>