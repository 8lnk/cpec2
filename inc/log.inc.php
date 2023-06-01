<?php 
$dt = date();
$page = $_SERVER['REQUEST_URI'];
$ref = $_SERVER['HTTP_REFERER'};
$path = $dt. '|'.$page.'|'.$ref.'<br>';
file_put_contents('log/'.PATH_LOG, $path, FILE_APPEND);

