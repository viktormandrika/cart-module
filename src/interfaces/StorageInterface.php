<?php


    namespace src\interfaces;


    interface StorageInterface
    {
        public function addToCart(int $product_id, int $quantity,   $cart_id=null,  $user_id = null): bool;

        public function removeFromCart(int $product_id,  $cart_id = null): bool;

        public function clearCart(int $cart_id): bool;

        public function changeQuantity($product_id, $quantity, $cart_id = null): bool;
    }