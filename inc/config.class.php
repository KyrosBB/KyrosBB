<?php
  class Config {
    var $vars = array();
    function __get($name) {
      return $this->vars[$name];
    }
    function __set($name, $value) {
      $this->vars[$name] = $value;
    }
    function load() {
      global $root;
      $cfg = array();
      include($root."cfg.php");
      $this->vars = $cfg;
    }
    function save() {
      global $root;
      $string = "<"."?php\n";
      foreach($this->vars as $key => $name) {
        $string .= "\$cfg[\"{$key}\"] = \"{$name}\";\n";
      }
      $string .= "?".">";
      $fh = fopen($root."cfg.php","w") or die("Unable to open cfg.php");
      fwrite($fh,$string);
      fclose($fh);
    }
  }
?>