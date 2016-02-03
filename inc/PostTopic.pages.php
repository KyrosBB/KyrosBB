<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $form = false;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $ptitle = isset($_POST["inputTitle"]) ? $_POST["inputTitle"] : false;
    $pcontent = isset($_POST["inputContent"]) ? $_POST["inputContent"] : false;
    if(!$ptitle||!$pcontent||$ptitle==""||$pcontent=="") {
      $form = true;
    } else {
      $ptitle = $db->real_escape_string($ptitle);
      $pcontent = $db->real_escape_string($pcontent);
      if(!$result = $db->query("INSERT INTO t(b) VALUES('{$ptitle}');")) {
        die($db->error);
      }
      $tid = $db->insert_id;
      if(!$result = $db->query("INSERT INTO p(a,b) VALUES('{$tid}','{$pcontent}');")) {
        die($db->error);
      }
      $wrapper->breadcrumbs = array(array(true,"","Topic created"));
      $html->pushID = $tid;
      $html->pushTitle = $ptitle;
      $wrapper->content = $html->render("{$themedir}forumTopicCreated.php");
    }
  } else {
    $form = true;
  }
  if($form) {
    $wrapper->breadcrumbs = array(
      array(true,"","Posting a new topic")
    );
    $wrapper->content = $html->render("{$themedir}forumNewTopic.php");
  }
?>