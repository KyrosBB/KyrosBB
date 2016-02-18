<?php
  class Display {
    function output() {
      global $theme;
      $template = $theme->template;
      
      echo $template;
      die;
    }
  }
?>
