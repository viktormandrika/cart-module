<?php
    session_start();
    require_once 'vendor/autoload.php';
    $config = require 'config/main_local.php';
    \src\Cart::run()->setConfig($config);


    if ($_POST) {
        if(\src\Cart::run()->addToCart($_POST['id'], $_POST['quantity'], true)){
            header('','', 200);
            echo \src\Cart::run()->jsonCartResponse();
        }else{
            header('','', 500);
        }

    }


