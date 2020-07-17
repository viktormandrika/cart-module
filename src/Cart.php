<?php


namespace src;


use src\classes\BaseStorage;
use src\interfaces\StorageInterface;

/**
 * Class CartEloquent
 * @package src
 * @property BaseStorage $storage
 * @property array $cart
 * @property string $jsonCart
 * @property array $config
 * @property int $user_id
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
    private $config;
    /**
     * @var int $user_id
     */
    protected $user_id;
    /**
     * @var StorageInterface $storage
     */
    protected $storage;
    /**
     * @var array $cart
     */
    protected $cart;
    /**
     * @var string $jsonCart
     */
    protected $jsonCart;


    /**
     * @param array $config
     * @param int|null $user_id
     *
     * @return Cart
     */
    public static function run($config, int $user_id = null)
    {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->setConfig($config, $user_id);
            self::$instance->setModuleMode();
            self::$instance->getCartFromStorage($user_id);
        }
        return self::$instance;
    }

    /**
     * @param array $config
     * @param int|null $user_id
     */
    private function setConfig(array $config, int $user_id = null): void
    {
        $this->config = $config;
        $this->storage = $this->config['storage']::getInstance($config, $user_id);
    }

    /**
     * @param int $product_id
     * @param int $quantity
     * @param int $user_id
     *
     * @return bool
     */
    public function addToCart(int $product_id, int $quantity, int $user_id = null): bool
    {
        $this->cart['products'][$product_id] = $quantity;
        return $this->storage->addToCart($product_id, $quantity, $user_id);
    }

    /**
     * @param int $product_id
     * @param int $user_id
     *
     * @return bool
     */
    public function removeFromCart(int $product_id, int $user_id = null): bool
    {
        unset($this->cart['products'][$product_id]);
        return $this->storage->removeFromCart($product_id, $user_id);

    }

    /**
     * @param int $user_id
     *
     * @return bool
     */

    public function clearCart(int $user_id = null): bool
    {
        $this->cart = [];
        return $this->storage->clearCart($user_id);
    }

    /**
     * @param int|null $user_id
     */
    private function getCartFromStorage(int $user_id = null): void
    {
        $this->cart = $this->storage->getCart($user_id);
    }

    private function jsonGenerate(): void
    {
        $this->jsonCart = json_encode($this->cart);
    }

    /**
     * @return string
     */
    public function jsonCartResponse(): string
    {
        $this->jsonGenerate();
        return $this->jsonCart;
    }

    /**
     * @return array
     */
    public function getCart()
    {
        return $this->cart;
    }

    protected function setModuleMode()
    {
        if ($this->config['mode'] == 'DEV') {
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
        }
    }
}