<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";

    $id = $_GET['id'] ? clearInt($_GET['id']) : null;
    add2Basket($id);
    header('Location: catalog.php');
