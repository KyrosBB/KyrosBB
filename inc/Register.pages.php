<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $html->message = false;
  $form = false;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["inputUsername"]) ? trim($_POST["inputUsername"]) : false;
    $email = isset($_POST["inputEmail"]) ? trim($_POST["inputEmail"]) : false;
    $password = isset($_POST["inputPassword"]) ? trim($_POST["inputPassword"]) : false;
    $pass2 = isset($_POST["inputPassword2"]) ? trim($_POST["inputPassword2"]) : false;
    if(!$username||!$email||!$password||!$pass2||$username==""||$email==""||$password==""||$pass2=="") {
      $html->message = "You must fill out the form completely.";
      $form = true;
    } else {
      $username = $db->real_escape_string($username);
      if(!$result = $db->query("SELECT * FROM users WHERE username='{$username}'")) {
        die($db->error);
      }
      if($result->num_rows == 1) {
        $html->message = "Username and/or already exists.";
        $form = true;
      } else if($password !== $pass2) {
        $html->message = "Passwords do not match.";
        $form = true;
      } else {
        $password = md5($password);
        $email = $db->real_escape_string($email);
        if(!$result = $db->query("INSERT INTO users VALUES('','{$username}','{$password}','{$email}','{$config->default_perms}','0')")) {
          die($db->error);
        }
        $wrapper->breadcrumbs = array(array(true,"","Account Registered"));
        $wrapper->content = $html->render("{$themedir}forumRegistered.php");
      }
    }
  } else {
    $form = true;
  }
  if($form) {
    $wrapper->breadcrumbs = array(array(true,"","Register"));
    $wrapper->content = $html->render("{$themedir}forumRegister.php");
  }
?>