<?php
    session_start();
    require_once 'vendor/autoload.php';
    $config = require 'config/main_local.php';
//$_SESSION['test'] = 1212;
    \src\Cart::run()->setConfig($config);
// \src\Cart::run()->addToCart(121, 12);
// \src\Cart::run()->addToCart(12, 12);
// \src\Cart::run()->addToCart(13, 12);

//    \src\Cart::run()->clearCart();
//    \src\Cart::run()->removeFromCart(13);

\src\Cart::run()->clearCart();
var_dump($_SESSION);
//    var_dump($_COOKIE);
//    var_dump($_SESSION);
   $cart = \src\Cart::run()->getProducts();
//   var_dump($cart);
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="cookie.js"></script>

<div class="products">
<?php foreach ($cart->cart['cart']['products'] as $product  => $quantity) :?>
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
     var res =    $('.form').serialize();
     var id = $('#id').val();
     var quantity = $('#quantity').val();
        $.ajax({
            url: '/request.php',
            method: 'post',
           data: {id: id, quantity: quantity},
            success: function(data){
                $.cookie('cart', data);
                alert(data);
            }
        });
        e.preventDefault();
    })

</script>