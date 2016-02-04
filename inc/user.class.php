<?php
  class User {
    var $avatar_type  = 1;
    var $email        = "anon@localhost";
    var $id           = 0;
    var $gravatar     = "5ad75fd2a5ff6caf0f609f54e594ac3a";
    var $username     = "Guest";
    var $perms        = "a:1:{i:0;a:2:{s:4:\"name\";s:8:\"Category\";s:3:\"ids\";a:2:{i:0;a:2:{s:2:\"id\";s:1:\"*\";s:5:\"perms\";a:3:{s:4:\"View\";i:0;s:4:\"Post\";i:0;s:5:\"Reply\";i:0;}}i:1;a:2:{s:2:\"id\";s:1:\"1\";s:5:\"perms\";a:3:{s:4:\"View\";i:1;s:4:\"Post\";i:0;s:5:\"Reply\";i:0;}}}}}";
    function get_gravatar($s="50",$extra=array()) {
      $build  = "<img src='";
      $build .= "http://www.gravatar.com/avatar/";
      $build .= $this->gravatar;
      $build .= "/?s=". $s;
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
    function generate_avatar($size=50, $extra=array()) {
      if($this->avatar_type == 1) {
        return $this->get_gravatar($size,$extra);
      }
    }
    function load($id) {
      global $db;
      if($result = $db->query("SELECT id,username FROM users WHERE id='{$id}'")) {
        while($row = $result->fetch_object()) {
          $this->id       = $row->id;
          $this->username = $row->username;
        }
      }
    }
  }
?>