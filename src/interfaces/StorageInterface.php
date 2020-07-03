<?php


    namespace src\interfaces;


    interface StorageInterface
    {
        public static function getInstance($config);

        public function addToCart(int $product_id, int $quantity, $is_ajax = false, $user_id = null): bool;

        public function removeFromCart(int $product_id, $user_id = null): bool;

        public function clearCart(int $user_id = null): bool;

        public function changeQuantity($product_id, $quantity, $user_id = null): bool;

        public function setCartProducts($user_id);

        public function jsonCartResponse($user_id);
    }