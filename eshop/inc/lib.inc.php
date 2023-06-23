<?php

function addItemToCatalog($link, $title, $author, $pubyear, $prise)
{
    $sql = "INSERT INTO catalog (title, author, pubyear, price) VAlUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "ssii", $title, $author, $pubyear, $prise);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function clearStr($str)
{
    $str = trim(strip_tags($str));
    return $str;
}
function clearInt($int)
{
    $int = abs((int)$int);
    return $int;
}

function selectAllItems($link)
{
    $sql = "SELECT id, title, author, pubyear, price FROM catalog";
    if (!$rsult = mysqli_query($link, $sql)) {
        return false;
    } else {
        $item = mysqli_fetch_all($rsult, MYSQLI_ASSOC);
        mysqli_free_result($rsult);
        return $item;
    }
}

function saveBasket()
{
    global $basket;
    $basket = base64_encode(serialize($basket));
    setcookie('basket', $basket, 0x7FFFFFFF);
}
function basketInit () 
{
    global $basket, $count;
    if (!isset($_COOKIE['basket'])) {
        $basket = ['orderid' => uniqid()];
        saveBasket();
    } else {
        $basket = unserialize(base64_decode($_COOKIE['basket']));
        $count = count($basket) - 1;
    }
}
function add2Basket ($id) {
    global $basket;
    $basket[$id] = 1;
    
    saveBasket();
}
function getBasketId ($basket) {
    $goodsId = array_keys($basket);
    array_shift($goodsId);
    if(empty($goodsId)) {
        return false;
    }
    foreach ($goodsId as $item) {
        $clearBasket[] = abs((int)$item);
    }
    return $clearBasket;
}

function myBasket ($link, $basket) { 
    $goodsId = getBasketId($basket);
    if($goodsId === false) {
        return false;
    }
    $idStr = implode(',', $goodsId);
    $sql =  "SELECT id, author, title, pubyear, price FROM catalog WHERE id IN ($idStr)";
    if(!$result = mysqli_query($link, $sql)){
        return false;
    }
    $item = result2Array($result);
    mysqli_free_result($result);
    return $item;
}

function result2Array ($result){
    global $basket;
    $arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $row['quantity'] = $basket[$row['id']];
        $arr[] = $row;
    }
    return $arr;
}
function deleteFromBasket($id) {
    global $basket;
    unset($basket[$id]);
    saveBasket();
}

function saveOrders ($datetime) {
    global $basket, $link;
    $goods = myBasket($link, $basket);
    $sql = "INSERT INTO orders ( title, author, pubyear, price, quantity, orderid, datetime) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if(!$stmt = mysqli_prepare($link, $sql)) {
        return false;
    }
    foreach ($goods as $item) {
        mysqli_stmt_bind_param($stmt, "ssiiisi", $item['title'], $item['author'], $item['pubyear'], $item['price'], $item['quantity'], $basket['orderid'], $datetime );
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    return true;
}

function getOrders () {
    global $link;
    if (!is_file(ORDERS_LOG)){
        return false;
    }
    $orders = file(ORDERS_LOG);
    $allOrders = [];
    foreach($orders as $order){
        list($customerName, $customerEmail, $customerPhone, $customerAddress, $orderId, $orderTime) = explode('|', $order);
        $orderInfo['name'] = $customerName;
        $orderInfo['email'] = $customerEmail;
        $orderInfo['phone'] = $customerPhone;
        $orderInfo['address'] = $customerAddress;
        $orderInfo['orderid'] = $orderId;
        $orderInfo['date'] = $orderTime;
        $sql = "SELECT title, author, pubyear, price, quantity FROM orders WHERE orderid = '$orderId' AND datetime = $orderTime"; 
        $result = mysqli_query($link, $sql);
        if(!$result) {
            return false;
        }
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $orderInfo['order'] = $items;
        $allOrders[] = $orderInfo;

    }
    return $allOrders;
}

function removeBasket(){
    setcookie('basket', '', time()-100);
}
    