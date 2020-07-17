<?php


namespace src\storage;


use src\classes\BaseStorage;

/**
 * Class Cookie
 * @property array $cart
 * @property array $config
 */
class Cookie extends BaseStorage
{
    public function __construct(array $configs, int $user_id = null)
    {
        parent::__construct($configs, $user_id);
        $this->setCart();
    }

    /**
     * @inheritDoc
     */
    public static function getInstance(array $config, int $user_id = null): object
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    public function addToCart(int $product_id, int $quantity, int $user_id = null): bool
    {
        $this->cart['products'][$product_id] = $quantity;
        return $this->saveCart();
    }

    /**
     * @inheritDoc
     */
    public
    function removeFromCart(int $product_id, int $user_id = null): bool
    {
        unset($this->cart['products'][$product_id]);
        return $this->saveCart();
    }

    /**
     * @inheritDoc
     */
    public
    function clearCart(int $user_id = null): bool
    {
        $this->cart['products'] = [];
        return $this->saveCart();

    }

    /**
     * @inheritDoc
     */
    protected function setCart(int $user_id = null): void
    {
        if (isset($_COOKIE['cart'])) {
            $this->cart = json_decode($_COOKIE['cart'], true);
        }
    }

    /**
     * @return bool
     */
    public
    function saveCart()
    {
        if (setcookie('cart', json_encode($this->cart, JSON_UNESCAPED_UNICODE), time() + $this->config['lifeTime'])) {
            return true;
        } else {
            return false;
        }
    }


}