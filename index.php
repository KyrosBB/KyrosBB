<?php
  include("asset/class/kyros.php");
  include("asset/class/hooks.php");
  include("asset/class/config.php");
  include("asset/class/session.php");
  include("asset/class/template.php");
  include("asset/class/user.php");
  include("asset/class/permissions.php");
  include("asset/class/utility.php");
  $kyros = new Kyros;
  $hooks = new Hooks;
  $config = new Config;
  $utility = new Utility;
  $config->load();
  $session = new Session;
  $db = new mysqli(
    $config->sql_hostname,
    $config->sql_username,
    $config->sql_password,
    $config->sql_database
  );
  if($db->connect_error) {
    die("Unable to connect to MySQLi");
  }
  foreach(glob("hooks/*.hook.php") as $file) {
    include($file);
  }
  $session->authorize();
  $session->user->permissions = new Permissions;
  $session->user->permissions->load($session->user->id);

  $kyros->theme = $utility->load_theme();
  $kyros->site_dir = $config->site_dir;

  $kyros->theme_dir = $config->theme_dir . $config->theme."/";
  $wrapper = new Template;
  $wrapper->admin_button = "";
  $wrapper->topic_button = "";
  $wrapper->hooks = $hooks;
  $wrapper->site_name = $config->site_name;
  $wrapper->site_dir = $config->site_dir;
  $categories = array();
  if($result = $db->query("SELECT * FROM categories")) {
    while($row = $result->fetch_object()) {
      $categories[] = $row;
    }
  } else {
    die($db->error);
  }
  $wrapper->categories = $categories;
  $act = isset($_GET["act"]) ? $_GET["act"] : "idx";
  $act = isset($_POST["act"]) ? $_POST["act"] : $act;
  include($kyros->get_act($act) .".php");
  $wrapper->user = $session->user;
  if($session->user->permissions->admin["view"] == "true") {
    $tmp = new Template;
    $tmp->site_dir = $config->site_dir;
    $wrapper->admin_button = $tmp->render($kyros->theme_dir ."sidebar/ad_button.php");
    unset($tmp);
  }
  if($session->user->permissions->category_post_count() >= 1) {
    $tmp = new Template;
    $tmp->site_dir = $config->site_dir;
    $wrapper->topic_button = $tmp->render($kyros->theme_dir ."sidebar/nt_button.php");
    unset($tmp);
  }

  // Set wrapper reference to $kyros
  $wrapper->kyros = $kyros;

  echo $wrapper->render($kyros->theme_dir ."wrapper.php");
?>