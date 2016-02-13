<?php
  class Utility {
    function load_theme() {
      global $db;
      $return = new stdclass;
      $id = 0;
      if($id > 0) {
      } else {
        if($result = $db->query("SELECT * FROM themes WHERE `default`='1'")) {
          $return = $result->fetch_object();
          include("themes/{$return->folder}/macros.php");
          $return->macros = new Macros;
        } else {
          die($db->error);
        }
      }
      return $return;
    }
  }
?>