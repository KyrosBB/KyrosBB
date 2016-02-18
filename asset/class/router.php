<?php
  class Router {
    public $bits;
    public $bitRoute;
    public $routes;
    function base_routes() {
      foreach(glob("routes/core/*.info.php") as $r) {
        include($r);
        $this->routes[$route["bit"]] = "routes/core/".$route["file"];
      }
    }
    function build() {
      $QS = $_SERVER["QUERY_STRING"];
      $QA = explode("/", $QS);
      unset($QA[0]);
      $QA = array_values($QA);
      $this->bits = $QA;
    }
    function find_route() {
      if(!isset($this->bits[0])) {
        $this->bitRoute = "routes/core/home.route";
      } else {
        if($this->bits[0] == "") {
          $this->bits[0] = "home";
        }
        if(array_key_exists($this->bits[0], $this->routes)) {
          $this->bitRoute = $this->routes[$this->bits[0]];
        } else {
          $this->bitRoute = "routes/error/404";
        }
      }
    }
    function getBit($k) {
      if(isset($this->bits[$k])) {
        return $this->bits[$k];
      } else {
        return false;
      }
    }
    function routeURI() {
      return $this->bitRoute .".php";
    }
  }
?>