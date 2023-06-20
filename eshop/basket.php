<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
	if (!myBasket($link, $basket)){
		echo "корзина пуста";
	}   else  { 
		$goods = myBasket($link, $basket);
		$i = 0;
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
<?php
	foreach ($goods as $item):
?>
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
<tr>
	<td><?= $i; ?></td>
	<td><?= $item['title']; ?></td>
	<td><?= $item['author']; ?>Автор</td>
	<td><?= $item['pubyear']; ?>Год издания</td>
	<td><?= $item['price']; ?>Цена, руб.</td>
	<td><?= $item['quantity']; ?>Количество</td>
	<td><a href=delete_from_basket.php?id=<?= $item['id']; ?>Удалить</td>
</tr>
<?php
endforeach;
?>
</table>

<p>Всего товаров в корзине на сумму: руб.</p>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>

</body>
</html>







