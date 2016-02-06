<?php
  class Kyros {
    private $choices = array("idx"=>"inc/BoardIndex.pages","login"=>"inc/Login.pages","newtopic"=>"inc/PostTopic.pages","register"=>"inc/Register.pages","reply"=>"inc/PostReply.pages","ST"=>"inc/ShowTopic.pages");
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
  }
?>