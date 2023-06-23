<?php
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customerName = clearStr($_POST['name']);
        $customerEmail = clearStr($_POST['email']);
        $customerPhone = clearStr($_POST['phone']);
        $customerAddress = clearStr($_POST['address']);
        $orderId = $basket['orderid'];
        $orderTime = time();
        $order = "$customerName|$customerEmail|$customerPhone|$customerAddress|$orderId|$orderTime\n";
        file_put_contents("admin/" . ORDERS_LOG, $order, FILE_APPEND);
        saveOrders($orderTime);
        removeBasket();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>