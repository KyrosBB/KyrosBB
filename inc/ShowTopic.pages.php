<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $continue = true;
  $id = isset($_GET["id"]) ? intval($_GET["id"]) : false;
  if(!$id||$id<1) {
    $wrapper->breadcrumbs = array(array(true,"","Error"));
    $html->message = "An ID must be a valid integer greater than or equal to 1.";
    $wrapper->content = $html->render($kyros->theme_dir ."error.php");
    $continue = false;
  }
  if($continue) {
    if(!$result = $db->query("SELECT * FROM t WHERE i='{$id}'")) {
      die($db->error);
    }
    if($result->num_rows < 1) {
      $wrapper->breadcrumbs = array(array(true,"","Error"));
      $html->message = "The requested topic doesn't exist.";
      $wrapper->content = $html->render($kyros->theme_dir ."error.php");
      $continue = false;
    } else {
      $topic = $result->fetch_array();
    }
  }
  if($continue) {
    $wrapper->breadcrumbs = array(
      array(false,"?act=ST&id={$topic["i"]}","{$topic["b"]}")
    );
    $posts = array();
    if($result = $db->query("SELECT * FROM p WHERE a='{$id}' ORDER BY i ASC")) {
      while($row = $result->fetch_array()) {
        $row["b"] = htmlspecialchars($row["b"]);
        $row["author"] = new User;
        $row["author"]->load($row["aid"]);
        $posts[] = $row;
      }
    }
    $html->topic_name = $topic["b"];
    $html->topic_id = $topic["i"];
    $html->posts = $posts;
    $wrapper->content = $html->render($kyros->theme_dir ."forumTopic.php");
  }
?>