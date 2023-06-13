<?
require "secure/session.inc.php";
require_once "../inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Форма добавления товара в каталог</title>
</head>
<body>

	<form action="save2cat.php" method="post">
		<p>Название: <input type="text" name="title" size="100" placeholder="<?=$_GET['title_error']??''; ?>">
		<p>Автор: <input type="text" name="author" size="50" placeholder="<?=$_GET['author_error']??''; ?>">
		<p>Год издания: <input type="text" name="pubyear" placeholder="<?=$_GET['pubyear_error']??''; ?>">
		<p>Цена: <input type="text" name="price" size="6" placeholder="<?=$_GET['price_error']??''; ?>"> руб.
		<p><input type="submit" value="Добавить">
	</form>
</body>
</html>