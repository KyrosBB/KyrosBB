<?php

  // 0.2.1 to 0.3.0
  $root = "../";
  include("../inc/config.class.php");
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

  // Add all new configurations
  // Define at default (generic)

  // Create all new sql tables
  $sql = array();
  $sql[] = "CREATE TABLE IF NOT EXISTS users (
  id int(100) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
  foreach($sql as $q) {
    if(!$result = $db->query($q)) {
      die($db->error);
    }
  }

  // Run table alters

  // Run data updates

  $config->save();
?>