<?php

try {
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_stock;charset=utf8;','root','');
} catch (\Exception $e) {
    die("une erreue a ete trouve : " . $e->getMessage());
}