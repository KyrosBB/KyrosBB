<?php
  include("asset/class/kyros.php");
  include("asset/class/hooks.php");
  include("asset/class/config.php");
  include("asset/class/session.php");
  include("asset/class/template.php");
  include("asset/class/user.php");
  $kyros = new Kyros;
  $hooks = new Hooks;
  $config = new Config;
  $session = new Session;

  $config->load();

  foreach(glob("hooks/*.hook.php") as $file) {
    include($file);
  }


  include("inc/permission.class.php");
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
  $session->user->permissions = new Permissions($session->user->perms);
  $wrapper->hooks = $hooks;

  $themedir = "themes/default/";
  $wrapper = new Template;
  $wrapper->site_name = $config->site_name;
  $wrapper->site_dir = $config->site_dir;
  $wrapper->user = $session->user;
  $categories = array();
  if($result = $db->query("SELECT * FROM categories")) {
    while($row = $result->fetch_object()) {
      $categories[] = $row;
    }
  } else {
    die($db->error);
  }
  $wrapper->categories = $categories;
  $active = array();
  $active_timeout = (time() - (60*15));
  if($result = $db->query("SELECT * FROM users WHERE activity > {$active_timeout}")) {
    while($row = $result->fetch_object()) {
      $tmp = new User;
      $tmp->generate($row);
      $active[] = $tmp;
    }
  } else {
    die($db->error);
  }
  $wrapper->active = $active;

  $act = isset($_GET["act"]) ? $_GET["act"] : "idx";
  $act = isset($_POST["act"]) ? $_POST["act"] : $act;

  include($kyros->get_act($act) .".php");

  echo $wrapper->render("{$themedir}wrapper.php");
?>