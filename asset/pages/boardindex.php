<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $crumbs = array();
  $topics = array();
  $sql = "SELECT * FROM t";
  $cid = isset($_GET["cat"]) ? intval($_GET["cat"]) : false;
  if(!$cid||$cid=="") {
    $crumbs[] = array(true,"","All Discussions");
  } else {
    foreach($wrapper->categories as $cat) {
      if($cat->id == $cid) {
        if($session->user->permissions->view_category($cid)) {
          $crumbs[] = array(false,"?cat={$cid}",$cat->name);
          $sql .= " WHERE cat='{$cid}'";
        }
      }
    }
  }
  if(count($crumbs) < 1) {
    $crumbs[] = array(true,"","All Discussions");
  }
  $sql .= " ORDER BY i DESC";
  if($result = $db->query($sql)) {
    while($row = $result->fetch_object()) {
      if($session->user->permissions->view_category($row->cat)) {
        $author = new User;
        $author->load($row->aid);
        $topics[] = array("id"=>$row->i,"name"=>$row->b,"author"=>$author);
      }
    }
  }
  $html->topics = $topics;
  $wrapper->breadcrumbs = $crumbs;
  $wrapper->content = $html->render($kyros->theme_dir."forumIndex.php");
?>