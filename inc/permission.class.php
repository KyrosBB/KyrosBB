<?php
  class Permissions {
    var $cat_can_view = array();
    var $cat_can_post = array();
    var $cat_can_reply = array();
    function __construct($perms) {
      $tmp = unserialize($perms);
      foreach($tmp as $k) {
        if($k["name"] == "Category") {
          foreach($k["ids"] as $k2) {
            foreach($k2["perms"] as $k3 => $v3) {
              if($k3 == "View") {
                $this->cat_can_view[$k2["id"]] = $v3;
              }
              if($k3 == "Post") {
                if($v3) {
                  $this->cat_can_post[$k2["id"]] = $v3;
                }
              }
              if($k3 == "Reply") {
                if($v3) {
                  $this->cat_can_reply[$k2["id"]] = $v3;
                }
              }
            }
          }
        }
      }
    }
    function category_view($id) {
      // Default is false.
      $return = false;
      foreach($this->cat_can_view as $cid => $perm) {
        if($cid == "*" || $cid == $id) {
          $return = $perm;
        }
      }
      return $return;;
    }
    function category_createTopic($id) {
    }
    function category_replyTopic($id) {
    }
  }
?>