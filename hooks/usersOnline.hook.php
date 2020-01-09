<?php
  function Update_Session() {
    global $session, $db;
    if($session->user->id !== 0) {
      $sql = "UPDATE users SET activity='". time() ."' WHERE id=". $session->user->id;
      if(!$result = $db->query($sql)) {
        die($db->error);
      }
    }
  }
  function Remove_Session() {
    global $session, $db;
    if($session->user->id !== 0) {
      $sql = "UPDATE users SET activity='0' WHERE id=". $session->user->id;
      if(!$result = $db->query($sql)) {
        die($db->error);
      }
    }
  }
  function Sidebar_UoBox($h) {
    global $db;
    $c = 0;
    $html = "<div class='panel panel-default oulist'><div class='panel-heading'>Online Users</div><div class='panel-body'>";
    $timeout = (time() - (60*15));
    if($result = $db->query("SELECT * FROM users WHERE activity > {$timeout}")) {
      $c = $result->num_rows;
      while($row = $result->fetch_object()) {
        $tmp = new User;
        $tmp->generate($row);
        $html .= $tmp->generate_avatar(25);
      }
    } else {
      die("We hit a snag... UOPlugin #1");
    }
    $html .= "</div></div>";
    if($c >= 1) {
      $h = str_replace("<% USERS_ONLINE %>", $html, $h);
    }
    return $h;
  }
  $hooks->add_action("session_auth", "Update_Session");
  $hooks->add_action("session_deauth", "Remove_Session");
  $hooks->add_filter("sidebar", "Sidebar_UoBox");
?>