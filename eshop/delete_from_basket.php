<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
	if($_GET['id']) {
		$id = clearInt($_GET['id']);
		deleteFromBasket($id);
	} 
	header("Location: basket.php");
	
