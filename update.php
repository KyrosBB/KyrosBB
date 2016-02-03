<?php

  // -dev TO 0.1.0 STABLE

  include("inc/config.class.php");
  $build = substr(getcwd(), strlen($_SERVER["DOCUMENT_ROOT"]));
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

  $config->save();
?>