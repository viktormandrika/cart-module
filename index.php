<?php

require_once 'vendor/autoload.php';
$config = require 'config/main_local.php';

new \src\classes\DBConnect($config['db']);

$cart = \src\Cart::run($config, 2);
$cart->addToCart(2,1, 2);
$cart->removeFromCart(1,1);
$cart->clearCart();

\src\models\CartEloquent::deleteOldCarts();