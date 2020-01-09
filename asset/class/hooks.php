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
    function filter($k, $h) {
      if(array_key_exists($k, $this->filters)) {
        foreach($this->filters[$k] as $v) {
          $h = $v($h);
        }
      }
      return $h;
    }
    function add_action($k, $v) {
      $this->actions[$k][] = $v;
    }
    function add_filter($k, $v) {
      $this->filters[$k][] = $v;
    }
  }
?>