<?php
/* Основные настройки */
const DB_HOST = "127.0.0.1";
const DB_NAME = "gbook";
const DB_LOGIN = "root";
const DB_PASSWORD = "root";

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die(mysqli_connect_error());
/* Основные настройки */
function clearStr($data) {
    global $link;
    $data = trim(strip_tags($data));
    return mysqli_real_escape_string($link, $data);
}
/* Сохранение записи в БД */
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = clearStr($_POST['name']);
    $email = clearStr($_POST['email']);
    $msg = clearStr($_POST['msg']);
    $sql = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";
    $result = mysqli_query($link, $sql);
    header("Location: " . "index.php?id=gbook");
    exit;
}
/* Сохранение записи в БД */

/* Удаление записи из БД */
if (isset($_GET['del'])) {
    $del = abs((int)$_GET['del']);
    $sql = "DELETE FROM msgs WHERE id = $del";
    $result = mysqli_query($link, $sql);
    header("Location: " . "index.php?id=gbook");
    exit;
}

/* Удаление записи из БД */
?>
<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
    Имя: <br /><input type="text" name="name" /><br />
    Email: <br /><input type="text" name="email" /><br />
    Сообщение: <br /><textarea name="msg"></textarea><br />

    <br />

    <input type="submit" value="Отправить!" />

</form>


<?php
/* Вывод записей из БД */

$sql = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt FROM msgs ORDER BY id DESC";
$result = mysqli_query($link, $sql);
$gbooks = mysqli_fetch_all($result, MYSQLI_ASSOC);
$countGbooks = mysqli_num_rows($result);
?>
<p>Всего записей в гостевой книге: <?= $countGbooks; ?></p> 
<?php 
foreach ($gbooks as $gbook):
    $dt = date('d-m-Y H-i-s', $gbook['dt']);
    $msg = nl2br($gbook['msg']);   
?>
<p> 
  <a href="mailto:<?php echo $gbook['email']; ?>"><?= $gbook['name']; ?></a> <?= $dt; ?>  
   написал<br /> <?= $msg; ?> 
</p> 
<p align="right">
  <a href="http://mysite.local/index.php?id=gbook&del=<?php echo $gbook['id']; ?>">Удалить</a>
</p>
<?php
    endforeach;
/* Вывод записей из БД */    
?>

