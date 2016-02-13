<?php
class Macros {
function xs_nt_button() {
global $kyros;
return <<<CDATA
<a class='btn btn-primary btn-xs' href='{$kyros->site_dir}?act=newtopic'>New Topic</a>
CDATA;
}
}
?>