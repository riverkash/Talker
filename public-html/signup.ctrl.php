<?php
  session_start();

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
    $_SESSION["msgid"] = "811";
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