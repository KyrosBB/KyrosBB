<?php
  class User {
    var $avatar_type  = 1;
    var $email        = "anon@localhost";
    var $id           = 0;
    var $gravatar     = "5ad75fd2a5ff6caf0f609f54e594ac3a";
    var $username     = "Guest";
    function get_gravatar($s="50",$extra=array()) {
      $build  = "<img src='";
      $build .= "http://www.gravatar.com/avatar/";
      $build .= $this->gravatar;
      $build .= "/?s=". $s;
      $build .= "'";
      $extra['title'] = $this->username;
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
    }
    function generate_avatar($size=50, $extra=array()) {
      if($this->avatar_type == 1) {
        return $this->get_gravatar($size,$extra);
      }
    }
    function load($id) {
      global $db;
      if($result = $db->query("SELECT * FROM users WHERE id='{$id}'")) {
        $ref = $result->fetch_object();
        $this->generate($ref);
      }
    }
  }
?>