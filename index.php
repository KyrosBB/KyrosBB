<?php
  include("inc/config.class.php");
  include("inc/template.class.php");
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

  $themedir = "themes/default/";
  $wrapper = new Template;
  $wrapper->site_name = $config->site_name;
  $wrapper->site_dir = $config->site_dir;

  $act = isset($_GET["act"]) ? $_GET["act"] : "idx";
  $act = isset($_POST["act"]) ? $_POST["act"] : $act;

  $choices = array("idx"=>"BoardIndex","newtopic"=>"PostTopic","ST"=>"ShowTopic","reply"=>"PostReply");
  if(!array_key_exists($act, $choices)) {
    $act = "idx";
  }
  include("inc/{$choices[$act]}.pages.php");

  echo $wrapper->render("{$themedir}wrapper.php");
?>