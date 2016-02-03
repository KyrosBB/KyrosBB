<?php
  $html = new Template;
  $wrapper->breadcrumbs = array();
  $topics = array();
  if($result = $db->query("SELECT * FROM t ORDER BY i DESC")) {
    while($row = $result->fetch_object()) {
      $topics[] = array("id"=>$row->i,"name"=>$row->b);
    }
  }
  $html->topics = $topics;
  $wrapper->content = $html->render("{$themedir}forumIndex.php");
?>