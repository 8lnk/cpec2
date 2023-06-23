<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/config.inc.php";
    $orders = getOrders();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Поступившие заказы</title>
	<meta charset="utf-8">
</head>
<body>
<h1>Поступившие заказы:</h1>
<?php
    foreach ($orders as $order):
?>
<hr>
<h2>Заказ номер: <?= $order['orderid']; ?></h2>
<p><b>Заказчик</b>: <?= $order['name']; ?></p>
<p><b>Email</b>: <?= $order['email']; ?></p>
<p><b>Телефон</b>: <?= $order['phone']; ?></p>
<p><b>Адрес доставки</b>: <?= $order['address']; ?> </p>
<p><b>Дата размещения заказа</b>: <?= date('d-m-Y H-i-s', $order['date']); ?></p>

<h3>Купленные товары:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
    
</tr>
    <?php
        foreach ($order['order'] as $item):
        $n = 1;
        $sumCost = 0;
    ?>
<tr>
    <td><?= $n ?></td>
    <td><?= $item['title']; ?></td>
    <td><?= $item['author']; ?></td>
    <td><?= $item['pubyear']; ?></td>
    <td><?= $item['price']; ?></td>
    <td><?= $item['quantity']; ?></td>
</tr>

<?php
    $n++;
    $sumCost += $item['price'];
    endforeach;
?>
</table>
<p>Всего товаров в заказе на сумму: <?= $sumCost ?>руб.</p>

</body>
</html>
<?php
    endforeach;
?>