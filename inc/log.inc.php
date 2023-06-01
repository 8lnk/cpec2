<?php 
$dt = date();
$page = $_SERVER['REQUEST_URI'];
$ref = $_SERVER['HTTP_REFERER'};
$paf = $dt. '|'.$page.'|'.$ref;
