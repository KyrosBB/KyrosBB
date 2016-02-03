<?php
  class User {
    var $avatar_type  = 1;
    var $email        = "anon@localhost";
    var $id           = 0;
    var $gravatar     = "5ad75fd2a5ff6caf0f609f54e594ac3a";
    var $username     = "Guest";
    var $perms        = "a:1:{i:0;a:2:{s:4:\"name\";s:8:\"Category\";s:3:\"ids\";a:1:{i:0;a:2:{s:2:\"id\";s:1:\"*\";s:5:\"perms\";a:3:{s:4:\"View\";b:1;s:4:\"Post\";b:1;s:5:\"Reply\";b:1;}}}}}";
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
    function generate($ref) {
      $this->email    = $ref->email;
      $this->id       = $ref->id;
      $this->gravatar = md5(strtolower(trim($ref->email)));
      $this->username = $ref->username;
      $this->perms    = $ref->perms;
    }
  }
?>