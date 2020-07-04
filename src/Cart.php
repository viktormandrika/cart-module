<?php


namespace src;


use src\interfaces\StorageInterface;

/**
 * Class Cart
 * @package src
 */
class Cart
{

    /**
     * @var
     */
    public static $instance;
    /**
     * @var array $config
     */
    public $config;
    /**
     * @var int $user_id
     */
    protected $user_id;
    /**
     * @var StorageInterface $storage
     */
    protected $storage;


    /**
     * @return Cart
     */
    public static function run()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $config
     */
    public function setConfig($config): void
    {
        $this->config = $config;
        $this->storage = $this->config['storage']::getInstance($config);
    }

    /**
     * @param int $product_id
     * @param int $quantity
     * @param int $user_id
     *
     * @return array
     */
    public function addToCart($product_id, $quantity, $user_id = null): array
    {
        return $this->storage->addToCart($product_id, $quantity, $user_id);

    }

    /**
     * @param int $product_id
     * @param int $user_id
     *
     * @return array
     */
    public function removeFromCart($product_id, $user_id = null): array
    {
        return $this->storage->removeFromCart($product_id, $user_id);

    }

    /**
     * @param int $cart_id
     *
     * @return array
     */

    public function clearCart($cart_id = null) :array
    {
        return $this->storage->clearCart($cart_id);
    }

    /**
     * @param int $product_id
     * @param int $quantity
     * @param int $user_id
     */

    public function changeQuantity($product_id, $quantity, $user_id = null): void
    {
        $this->storage->changeQuantity($product_id, $quantity, $user_id);
    }


    /**
     * @param null $user_id
     *
     * @return mixed
     */
    public function jsonCartResponse($user_id = null)
    {
        return $this->storage->jsonCartResponse($user_id);
    }

    public function getCart(): array
    {
        return $this->storage->getCart();
    }
}