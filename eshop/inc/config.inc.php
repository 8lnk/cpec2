<?php
define('DB_HOST', '127.0.0.1');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'eshop');
define('ORDERS_LOG', 'orders.log');


$basket = [];
$count = 0;

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
if (!$link) {
    echo 'Ошибка' . mysqli_connect_errno() . ':' . mysqli_connect_error();
}

basketInit();
