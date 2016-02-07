<?php
  class Config {
    var $vars = array();
    function __get($k) {
      return $this->vars[$k];
    }
    function __set($k, $v) {
      $this->vars[$k] = $v;
    }
    function load() {
      global $root;
      $cfg = array();
      include("cfg.php");
      $this->vars = $cfg;
    }
  }
?>