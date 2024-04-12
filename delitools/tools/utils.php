<?php

function pre($data) {
    echo '<pre>'.print_r($data, true).'</pre>';
}

function module($name) {
    include $_SERVER["DOCUMENT_ROOT"]."/modules/$name/template.php";
}