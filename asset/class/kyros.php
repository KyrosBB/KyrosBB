<?php
  class Kyros {
    public $version = "0.6.0-dev";
    private $choices = array(
        "idx"=>"asset/pages/boardindex",
        "login"=>"inc/Login.pages",
        "newtopic"=>"inc/PostTopic.pages",
        "register"=>"inc/Register.pages",
        "reply"=>"inc/PostReply.pages",
        "ST"=>"inc/ShowTopic.pages",
        "acp" => "asset/pages/admin_idx"
    );
    function add_act($k,$v) {
      if(!array_key_exists($k, $this->choices)) {
        $this->choices[$k] = $v;
      }
    }
    function get_act($k) {
      if(!array_key_exists($k, $this->choices)) {
        return $this->choices["idx"];
      } else {
        return $this->choices[$k];
      }
    }
    function create_permission($i) {
      $p = file_get_contents("asset/perms/default.perm");
      $handle = fopen("asset/perms/{$i}.perm", "w");
      if($handle) {
        fwrite($handle, $p);
        fclose();
      } else {
        die("Cannot create permission file.");
      }
    }
  }
?>