<?php
  // Due to the config class being used by the updater... we need a $root...
  $root = "./";
  include("inc/config.class.php");
  include("inc/template.class.php");
  include("inc/user.class.php");
  include("inc/session.class.php");
  $session = new Session;
  $config = new Config;
  $config->load();
  $db = new mysqli(
    $config->sql_hostname,
    $config->sql_username,
    $config->sql_password,
    $config->sql_database
  );
  if($db->connect_error) {
    die($db->connect_error);
  }
  $session->authorize();

  $themedir = "themes/default/";
  $wrapper = new Template;
  $wrapper->site_name = $config->site_name;
  $wrapper->site_dir = $config->site_dir;
  $wrapper->user = $session->user;

  $act = isset($_GET["act"]) ? $_GET["act"] : "idx";
  $act = isset($_POST["act"]) ? $_POST["act"] : $act;

  $choices = array(
    "idx"       => "BoardIndex",
    "login"     => "Login",
    "newtopic"  => "PostTopic",
    "reply"     => "PostReply",
    "ST"        => "ShowTopic"
  );
  if(!array_key_exists($act, $choices)) {
    $act = "idx";
  }
  include("inc/{$choices[$act]}.pages.php");

  echo $wrapper->render("{$themedir}wrapper.php");
?>