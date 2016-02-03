<?php
  class Session {
    var $user;
    function __construct() {
      session_start();
    }
    function authorize() {
      global $db;
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
    }
  }
?>