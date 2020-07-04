<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once 'vendor/autoload.php';
$config = require 'config/main_local.php';

\src\Cart::run()->setConfig($config);

//\src\Cart::run()->clearCart()
//\src\Cart::run()->removeFromCart(11);

$cart = \src\Cart::run()->getCart();

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="cookie.js"></script>

<div class="products">
    <?php foreach ($cart['products'] as $product => $quantity) : ?>
        Продукт: <?= $product ?> <br>
        Количествуо : <?= $quantity ?><br><br>
    <?php endforeach; ?>
</div>


<form id="form">
    <input id="id" type="text" name="id">
    <input id="quantity" type="text" name="quantity">
    <input name="add_to_cart" type="button" value="Send" class="add">
</form>

<script>


    $('.add').on('click', function (e) {
        var id = $('#id').val();
        var quantity = $('#quantity').val();
        $.ajax({
            url: '/request.php',
            method: 'post',
            data: {id: id, quantity: quantity},
            success: function (data) {
                $.cookie('cart', data);
                alert(data);
            }
        });
    })

</script>