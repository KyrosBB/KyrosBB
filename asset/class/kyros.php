<?php
  class Kyros {
    private $choices = array("idx"=>"BoardIndex.pages","login"=>"Login.pages","newtopic"=>"PostTopic.pages","register"=>"Register.pages","reply"=>"PostReply.pages","ST"=>"ShowTopic.pages");
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