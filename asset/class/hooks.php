<?php
  class Hooks {
    private $actions = array();
    private $filters = array();
    function action($k) {
      if(array_key_exists($k, $this->actions)) {
        foreach($this->actions[$k] as $v) {
          $v();
        }
      }
    }
    function add_action($k, $v) {
      $this->actions[$k][] = $v;
    }
  }
?>