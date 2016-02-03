<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $id = isset($_GET["id"]) ? intval($_GET["id"]) : false;
  if(!$id||$id<1) {
    $wrapper->breadcrumbs = array(array(true,"","Error"));
  }
?>
