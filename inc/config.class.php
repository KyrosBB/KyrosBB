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
      $cfg = array();
      include("cfg.php");
      $this->vars = $cfg;
    }
    function save() {
      $string = "<"."?php\n";
      foreach($this->vars as $key => $name) {
        $string .= "\$cfg[\"{$key}\"] = \"{$name}\";\n";
      }
      $string .= "?".">";
      $fh = fopen("cfg.php","w") or die("Unable to open cfg.php");
      fwrite($fh,$string);
      fclose($fh);
    }
  }
?>