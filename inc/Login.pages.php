<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $form = false;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["inputUsername"]) ? trim($_POST["inputUsername"]) : false;
    $password = isset($_POST["inputPassword"]) ? trim($_POST["inputPassword"]) : false;
    if(!$username||!$password||$username==""||$password=="") {
      $form = true;
    } else {
    }
  } else {
    $form = true;
  }
  if($form) {
    $wrapper->breadcrumbs = array(array(true,"","Log In"));
    $wrapper->content = $html->render("{$themedir}forumLogin.php");
  }
?>
