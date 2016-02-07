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
  $hooks->add_action("session_auth", "Update_Session");
?>