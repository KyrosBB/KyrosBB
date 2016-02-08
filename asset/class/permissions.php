<?php
  class Permissions {
    var $account  = array();
    var $admin    = array();
    var $category = array();
    function load($i) {
      $handle = fopen("asset/perms/". $i .".perm", "r");
      if($handle) {
        while(($line = fgets($handle)) !== false) {
          $line = trim(str_replace("\r\n", "", $line));
          if($line !== "") {
            $perm = explode(":", $line);
            $perm_value = $perm[1];
            $perm = explode(".", $perm[0]);
            if($perm[0] == "Account") {
              $this->account[$perm[1]] = $perm_value;
            } else if($perm[0] == "Admin") {
              $this->admin[$perm[1]] = $perm_value;
            } else if($perm[0] == "Category") {
              $this->category[$perm[1]][$perm[2]] = $perm_value;
            }
          }
        }
        fclose($handle);
      } else {
        die("Unable to load permission file.");
      }
    }
    function view_category($i) {
      // Get the global permission first.
      $return = $this->category["*"]["view"];
      if(array_key_exists($i,$this->category)) {
        if(array_key_exists("view", $this->category[$i])) {
          $return = $this->category[$i]["view"];
        }
      }
      return $return;
    }
    function post_category($i) {
      // Get the global permission first.
      $return = $this->category["*"]["post"];
      if(array_key_exists($i,$this->category)) {
        if(array_key_exists("post", $this->category[$i])) {
          $return = $this->category[$i]["post"];
        }
      }
      return $return;
    }
    function reply_category($i) {
      // Get the global permission first.
      $return = $this->category["*"]["reply"];
      if(array_key_exists($i,$this->category)) {
        if(array_key_exists("reply", $this->category[$i])) {
          $return = $this->category[$i]["reply"];
        }
      }
      return $return;
    }
    function category_post_count() {
      $i = 0;
      foreach($this->category as $v) {
        if($v["post"] == "true") {
          $i++;
        }
      }
      return $i;
    }
  }
?>