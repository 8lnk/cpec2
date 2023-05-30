<?php
$visitCounter = 0;
$lastVisit = "";

if (isset($_COOKIE['visitCounter'])) {
    $visitCounter = $_COOKIE['visitCounter'];
}

$visitCounter++;

if (isset($_COOKIE['lastVisit'])) {
    $lastVisit = date('d-m-Y', $_COOKIE['lastVisit']);
}

if ($lastVisit != date('d-m-Y')) {
    setcookie('visitCounter', $visitCounter, 0x7FFFFFFF);
    setcookie('lastVisit', time(), 0x7FFFFFFF);
}
