<?php
  /**
   * @author  Chad Minick <http://chadminick.com>
   * @createDate 2009-09-30
   */
  class Template {
    private $vars = array();
    function __get($name) {
      return $this->vars[$name];
    }
    function __set($name, $value) {
      if($name == "view_template_file") {
        die("Cannot bind variable named \"view_template_file\"");
      }
      $this->vars[$name] = $value;
    }
    function render($view_template_file) {
      if(array_key_exists("view_template_file", $this->vars)) {
        die("Cannot bind variable named \"view_template_file\"");
      }
      extract($this->vars);
      ob_start();
      include($view_template_file);
      return ob_get_clean();
    }
  }
?>