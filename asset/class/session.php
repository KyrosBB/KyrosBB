<?php
  class Session {
    var $user;
    function __construct() {
      session_start();
    }
    function remove_session() {
      unset($_SESSION["username"]);
      unset($_SESSION["password"]);
    }
    function authorize() {
      global $db;
      $this->user = new User;
      if(isset($_SESSION["username"]) && isset($_SESSION["password"])) {
        $t = $db->real_escape_string($_SESSION["username"]);
        if($result = $db->query("SELECT * FROM users WHERE username='". $t ."'")) {
          if($result->num_rows !== 1) {
            $this->remove_session();
          } else {
            $test = $result->fetch_object();
            if($_SESSION["password"] == md5($test->password)) {
              $this->user->generate($test);
            } else {
              $this->remove_session();
            }
          }
        } else {
          die($db->error);
        }
      }
    }
  }
?>