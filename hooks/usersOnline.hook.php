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
  function Sidebar_UoBox() {
    global $db;
    echo "<div class='panel panel-default'><div class='panel-heading'>Online Users</div><div class='panel-body'>";
    $timeout = (time() - (60*15));
    if($result = $db->query("SELECT * FROM users WHERE activity > {$timeout}")) {
      while($row = $result->fetch_object()) {
        $tmp = new User;
        $tmp->generate($row);
        echo $tmp->generate_avatar(25);
      }
    } else {
      die("We hit a snag... UOPlugin #1");
    }
    echo "</div></div>";
  }
  $hooks->add_action("session_auth", "Update_Session");
  $hooks->add_action("sidebar_end", "Sidebar_UoBox");
?>