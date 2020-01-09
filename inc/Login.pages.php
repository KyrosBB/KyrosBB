<?php
  if($session->user->id >= 1) {
    $hooks->action("session_deauth");
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    $session->user = new User;
    $session->user->permissions = new Permissions;
    $session->user->permissions->load(0);
  }
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $form = false;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["inputUsername"]) ? trim($_POST["inputUsername"]) : false;
    $password = isset($_POST["inputPassword"]) ? trim($_POST["inputPassword"]) : false;
    if(!$username||!$password||$username==""||$password=="") {
      $form = true;
    } else {
      $username = $db->real_escape_string($username);
      if(!$result = $db->query("SELECT * FROM users WHERE username='{$username}'")) {
        die($db->error);
      }
      if($result->num_rows !== 1) {
        $form = true;
      } else {
        $test = $result->fetch_object();
        if(md5($password) == $test->password) {
          $_SESSION["username"] = $username;
          $_SESSION["password"] = md5(md5($password));
          $wrapper->breadcrumbs = array(array(true,"","Logged In"));
          $wrapper->content = $html->render($kyros->theme_dir ."forumLoggedIn.php");
        } else {
          $form = true;
        }
      }
    }
  } else {
    $form = true;
  }
  if($form) {
    $wrapper->breadcrumbs = array(array(true,"","Log In"));
    $wrapper->content = $html->render($kyros->theme_dir ."forumLogin.php");
  }
?>