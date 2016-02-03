<?php
  class Session {
    var $user;
    function __construct() {
      // We should only start sessions here.
      session_start();
    }
    function authorize() {
      // Build on this later, right now, just call a user class, which idents for a guest.
      
      $this->user = new User;
    }
  }
?>