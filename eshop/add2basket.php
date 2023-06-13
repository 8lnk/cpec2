<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";

    $id = $_GET['id'] ?? null;
    $count = 1;
    add2Basket($id);
    header('Location: catalog.php');
