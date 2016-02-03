<?php
  class User {
    var $avatar_type  = 1;
    var $email        = "anon@localhost";
    var $id           = 0;
    var $gravatar     = "5ad75fd2a5ff6caf0f609f54e594ac3a";
    var $username     = "Guest";
    function get_gravatar($extra=array()) {
      $build  = "<img src='";
      $build .= "http://www.gravatar.com/avatar/";
      $build .= $this->gravatar;
      $build .= "'";
      foreach($extra as $key=>$val) {
        $build .= " {$key}='{$val}'";
      }
      $build .= ">";
      return $build;
    }
  }
?>