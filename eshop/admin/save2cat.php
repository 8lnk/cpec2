<?php
// подключение библиотек
require "secure/session.inc.php";
require "../inc/config.inc.php";
require "../inc/lib.inc.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $req_fields = ['title', 'author', 'pubyear', 'price'];
    $errors = [];
    $form = $_POST;
    foreach ($req_fields as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Поле должно быть заполнено!';
        }
    }
    if (count($errors)) {
        $getQuer = '?';
        if (isset($errors['title'])) {
            $getQuer .= "title_error={$errors['title']}";
        } 
        if (isset($errors['author'])) {
            $getQuer .= "&author_error={$errors['author']}";
        } 
        if (isset($errors['pubyear'])) {
            $getQuer .= "&pubyear_error={$errors['pubyear']}";
        } 
        if(isset($errors['price'])) {
            $getQuer .= "&price_error={$errors['price']}";
        }
        header('Location: add2cat.php' . $getQuer);
        exit;
    }

    $title = clearStr($form['title']);
    $author = clearStr($form['author']);
    $pubyear = abs((int)$form['pubyear']);
    $price = abs((int)$form['price']);


    if(!addItemToCatalog($link, $title, $author, $pubyear, $price)) {
        echo 'Произошла ошибка при добавлении товара в каталог';
        
    } else {

        header('Location: add2cat.php');
        exit;
    }
} 
