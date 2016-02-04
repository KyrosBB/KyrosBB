<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $continue = true;
  $form = false;
  $id = isset($_GET["id"]) ? intval($_GET["id"]) : false;
  $id = isset($_POST["id"]) ? intval($_POST["id"]) : $id;
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
      $pcontent = isset($_POST["inputContent"]) ? $_POST["inputContent"] : false;
      if(!$pcontent||$pcontent=="") {
        $form = true;
      } else {
        $pcontent = $db->real_escape_string($pcontent);
        if(!$result = $db->query("INSERT INTO p(a,b,aid) VALUES('{$topic["i"]}','{$pcontent}','{$session->user->id});")) {
          die($db->error);
        }
        $wrapper->breadcrumbs = array(array(true,"","Reply posted"));
        $html->pushTitle = $topic["b"];
        $html->pushID = $topic["i"];
        $wrapper->content = $html->render("{$themedir}forumReplyCreated.php");
      }
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