<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
	if($_GET['id']){
	$id = clearInt($_GET['id']);
	add2Basket($id);	
	}
    
    
    header('Location: catalog.php');
