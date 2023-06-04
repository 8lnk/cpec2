<?php
/* Основные настройки */

const DB_HOST = 'localhost';
const DB_LOGIN = 'root';
const DB_PASSWORD = 'root';
const DB_NAME = 'gbook';
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

/* Основные настройки */

/* Сохранение записи в БД */

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['name'])) {
        $name = trim(strip_tags($_POST['name']));
        $name = mysqli_real_escape_string($link, $name);
    } else {
        $name = false;
    }
    if (isset($_POST['email'])) {
        $email = trim(strip_tags($_POST['email']));
        $email = mysqli_real_escape_string($link, $email);
    } else {
        $email = '';
    }
    if (isset($_POST['msg'])) {
        $msg = htmlspecialchars($_POST['msg']);
        $msg = mysqli_real_escape_string($link, $msg);
    } else {
        $msg = false;
    }
    if ($name && $msg) {
        $sql = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";
        $result = mysqli_query($link, $sql);
        
    } else {
        echo "<br> НЕ ВСЕ ПОЛЯ ЗАПОЛНЕНЫ";
        header("Location: " . $_SERVER["REQUEST_URI"]);
    }
    
    header("Location: " . $_SERVER["REQUEST_URI"]);
}


/* Сохранение записи в БД */

/* Удаление записи из БД */

if(isset($_GET['del'])) {
    $del =(int)$_GET['del'];
    $sql = "DELETE FROM msgs WHERE id = $del";
    $result = mysqli_query($link, $sql);
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
$sql = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt 
FROM msgs 
ORDER BY id DESC";
$result = mysqli_query($link, $sql);
$gbooks = mysqli_fetch_all($result, MYSQLI_ASSOC);
// foreach ($gbooks as $gbook) {
//     echo "Пользователь {$gbook['name']} (email: {$gbook['email']})";
//     echo "<br> Сообщение: <br> {$gbook['msg']}";
//     $date = date('d-m-Y в H-i-s', $gbook['datetime']);
//     echo "<br> Дата публикации: <br> $date <br><br>";
// }
/* Вывод записей из БД */
?>
 <p>Всего записей в гостевой книге: количество записей</p>
<?php
    foreach ($gbooks as $gbook):
        $date = date('d-m-Y в H-i-s', $gbook['datetime']);
?> 
 <p> 
  <a href="<?= $gbook['email'] ?>"><?= $gbook['name']; ?></a> <?= $date; ?>  
   написал<br /><?= $gbook['msg']; ?>
</p> 
<p align="right">
  <a href="http://mysite.local/index.php?id=gbook&del=<?php echo $gbook['id']; ?>">Удалить</a>
</p> 
<?php
    endforeach;
?>