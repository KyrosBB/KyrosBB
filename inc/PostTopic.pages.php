<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $html->user = $session->user;
  $html->categories = $wrapper->categories;
  $form = false;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $ptitle = isset($_POST["inputTitle"]) ? $_POST["inputTitle"] : false;
    $pcontent = isset($_POST["inputContent"]) ? $_POST["inputContent"] : false;
    $pcat = isset($_POST["inputCategory"]) ? $_POST["inputCategory"] : false;
    $pcat = intval($pcat);
    if(!$ptitle||!$pcontent||$ptitle==""||$pcontent=="") {
      $form = true;
    } else if($session->user->permissions->post_category($pcat) == "false") {
      $form = true;
    } else {
      $ptitle = $db->real_escape_string($ptitle);
      $pcontent = $db->real_escape_string($pcontent);
      if(!$result = $db->query("INSERT INTO t(cat,b,aid) VALUES('{$pcat}','{$ptitle}','{$session->user->id}');")) {
        die($db->error);
      }
      $tid = $db->insert_id;
      if(!$result = $db->query("INSERT INTO p(a,b,aid) VALUES('{$tid}','{$pcontent}','{$session->user->id}');")) {
        die($db->error);
      }
      $wrapper->breadcrumbs = array(array(true,"","Topic created"));
      $html->pushID = $tid;
      $html->pushTitle = $ptitle;
      $wrapper->content = $html->render($kyros->theme_dir ."forumTopicCreated.php");
    }
  } else {
    $form = true;
  }
  if($form) {
    $wrapper->breadcrumbs = array(
      array(true,"","Posting a new topic")
    );
    $wrapper->content = $html->render($kyros->theme_dir ."forumNewTopic.php");
  }
?>