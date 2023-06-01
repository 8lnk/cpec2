<?php 
$dt = time();
//$page = $_SERVER['REQUEST_URI'];
//$page = $_SERVER['QUERY_STRING'];
$page = $_GET['id']??'index';
$ref = $_SERVER['HTTP_REFERER'};
$ref = pathinfo($ref, PATHINFO_BASENAME);              
$path = $dt. '|'.$page.'|'.$ref.'<br>';
file_put_contents('log/'.PATH_LOG, $path, FILE_APPEND);

