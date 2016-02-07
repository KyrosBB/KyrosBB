<?php
  class Session {
    var $user;
    function __construct() {
      session_start();
    }
    function update_activity() {
      global $db;
      $sql = "UPDATE users SET activity='". time() ."' WHERE id=". $this->user->id;
      if(!$result = $db->query($sql)) {
        die($db->error);
      }
    }
    function authorize() {
      global $db, $hooks;
      if(isset($_SESSION["username"]) && isset($_SESSION["password"])) {
        $tu = $db->real_escape_string($_SESSION["username"]);
        if($result = $db->query("SELECT * FROM users WHERE username='{$tu}'")) {
          if($result->num_rows !== 1) {
            unset($_SESSION["username"]);
            unset($_SESSION["password"]);
            $this->user = new User;
          } else {
            $test = $result->fetch_object();
            if($_SESSION["password"] == md5($test->password)) {
              $this->user = new User;
              $this->user->generate($test);
              //$this->update_activity();
            } else {
              unset($_SESSION["username"]);
              unset($_SESSION["password"]);
              $this->user = new User;
            }
          }
        } else {
          die($db->error);
        }
      } else {
        $this->user = new User;
      }
      $hooks->action("session_auth");
    }
  }
?>