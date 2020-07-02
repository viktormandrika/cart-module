<?php


    namespace src\interfaces;


    interface Storage
    {
        public static function addToCart();

        public static function removeFromCart();

        public static function clearCart();

        public static function changeQuantity();
    }