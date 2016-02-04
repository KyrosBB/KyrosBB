<?php
  $html = new Template;
  $html->site_dir = $config->site_dir;
  $crumbs = array();
  $topics = array();
  $sql = "SELECT * FROM t";
  // Are we trying to view a specific category?
  $cid = isset($_GET["cat"]) ? intval($_GET["cat"]) : false;
  if(!$cid||$cid=="") {
    // Nope, we need them all.
    $crumbs[] = array(true,"","All Discussions");
  } else {
    // Does it exist?
    foreach($wrapper->categories as $cat) {
      if($cat->id == $cid) {
        // Can we view it?
        if($session->user->permissions->category_view($cid)) {
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
      if($session->user->permissions->category_view($row->cat)) {
        $author = new User;
        $author->load($row->aid);
        $topics[] = array("id"=>$row->i,"name"=>$row->b,"author"=>$author);
      }
    }
  }
  $html->topics = $topics;
  $wrapper->breadcrumbs = $crumbs;
  $wrapper->content = $html->render("{$themedir}forumIndex.php");
?>