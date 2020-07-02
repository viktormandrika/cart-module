<?php
    require_once 'vendor/autoload.php';
    $config = require 'config/main_local.php';

    \src\Cart::run()->setConfig($config);
    \src\Cart::run()->addToCart(11, 12);

//    \src\Cart::run()->clearCart();
//    \src\Cart::run()->removeFromCart(22);


    var_dump($_COOKIE);