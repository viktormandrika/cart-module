<?php


namespace src\interfaces;


interface StorageInterface
{
    /**
     * @param array $config
     * @param int $user_id
     * @return object
     */
    public static function getInstance(array $config, int $user_id = null): object;

    /**
     * @param int $product_id
     * @param int $quantity
     * @param int|null $user_id
     * @return bool
     */
    public function addToCart(int $product_id, int $quantity, int $user_id = null): bool ;

    /**
     * @param int $product_id
     * @param int|null $user_id
     * @return bool
     */
    public function removeFromCart(int $product_id, int $user_id = null): bool;

    /**
     * @param int|null $user_id
     * @return bool
     */
    public function clearCart(int $user_id = null): bool;

    /**
     * @param integer|null $user_id
     * @return array
     */

    public function getCart(int $user_id = null) :array ;
}