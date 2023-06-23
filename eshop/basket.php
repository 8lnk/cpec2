<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
	if (!myBasket($link, $basket)){
		echo "корзина пуста";
        echo "<a href='catalog.php'> Вернуться в каталог </a>";
	}   else  { 
		$goods = myBasket($link, $basket);
		$i = 0;
		$sum = 0;
		echo "<a href='catalog.php'> Вернуться в каталог </a>";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Корзина пользователя</title>
</head>
<body>
	
	<h1>Ваша корзина</h1>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php
if (isset($goods)):
	foreach ($goods as $item):
		$sum += $item['price'];
        $i++;
?>
<tr>
	<td><?= $i; ?></td>
	<td><?= $item['title']; ?></td>
	<td><?= $item['author']; ?></td>
	<td><?= $item['pubyear']; ?></td>
	<td><?= $item['price']; ?></td>
	<td><?= $item['quantity']; ?></td>
	<td><a href="delete_from_basket.php?id=<?= $item['id']; ?>"> Удалить </a></td>
</tr>
<?php
endforeach;
endif;
?>

</table>
<?php
if (!isset($goods)) {
    echo "корзина пуста";
    
}    
?>
<p>Всего товаров в корзине на сумму: <?= $sum??0 ?> руб.</p>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>

</body>
</html>







