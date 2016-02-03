<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $continue = true;
  $form = false;
  $id = isset($_GET["id"]) ? intval($_GET["id"]) : false;
  if(!$id||$id<1) {
    $wrapper->breadcrumbs = array(array(true,"","Error"));
    $html->message = "An ID must be a valid integer greater than or equal to 1.";
    $wrapper->content = $html->render("{$themedir}/error.php");
    $continue = false;
  }
  if($continue) {
    if(!$result = $db->query("SELECT * FROM t WHERE i='{$id}'")) {
      die($db->error);
    }
    if($result->num_rows < 1) {
      $wrapper->breadcrumbs = array(array(true,"","Error"));
      $html->message = "Cannot reply to a non-existant topic.";
      $wrapper->content = $html->render("{$themedir}/error.php");
      $continue = false;
    } else {
      $topic = $result->fetch_array();
    }
  }
  if($continue) {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    } else {
      $form = true;
    }
  }
  if($form) {
    $wrapper->breadcrumbs = array(
      array(true,"","Posting Reply"),
      array(false,"?act=ST&id={$topic["i"]}",$topic["b"])
    );
    $html->topic_id = $topic["i"];
    $html->topic_name = $topic["b"];
    $wrapper->content = $html->render("{$themedir}forumNewReply.php");
  }
?>