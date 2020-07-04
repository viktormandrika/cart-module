<?php


namespace src\interfaces;


interface StorageInterface
{
    /**
     * @param array $config
     * @return mixed
     */
    public static function getInstance(array $config) :object ;

    /**
     * @param int $product_id
     * @param int $quantity
     * @param null $user_id
     * @return array
     */
    public function addToCart(int $product_id, int $quantity, $user_id = null): array;

    /**
     * @param int $product_id
     * @param int|null $user_id
     * @return array
     */
    public function removeFromCart(int $product_id, int $user_id = null) : array ;

    /**
     * @param int|null $user_id
     * @return array
     */
    public function clearCart(int $user_id = null): array;

    /**
     * @param integer $product_id
     * @param integer $quantity
     * @param integer $user_id
     * @return bool
     */
    public function changeQuantity(int $product_id, int $quantity, int $user_id = null): bool;

    /**
     * @param integer $user_id
     * @return string mixed
     */
    public function jsonCartResponse($user_id): string;

}