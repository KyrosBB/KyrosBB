<?php
    if($session->user->permissions->admin["view"] == "false") {
        header("Location: ./index.php");
        exit;
    }
    $wrapper->breadcrumbs = array(array(true,'','Admin CP'));
    $wrapper->sidebar = false;
    $wrapper->content = "";
?>
