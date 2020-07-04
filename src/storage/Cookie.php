<?php


namespace src\storage;


use src\classes\BaseStorage;

class Cookie extends BaseStorage
{
    /**
     * @inheritDoc
     */

    public static function getInstance($config):object
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    public function addToCart(int $product_id, int $quantity, $is_ajax = false, $user_id = null): array
    {
        $this->cart['products'][$product_id] = $quantity;
        return $this->saveCart()->getCart();
    }


    /**
     * @inheritDoc
     */
    public
    function removeFromCart(int $product_id, int $user_id = null): array
    {
        unset($this->cart['products'][$product_id]);
        return $this->saveCart()->getCart();
    }


    /**
     * @param int $user_id
     *
     * @return array
     */
    public
    function clearCart(int $user_id = null): array
    {
        $this->cart['products'] = [];
        $this->saveCart();
        return $this->getCart();

    }

    /**
     * @inheritDoc
     */
    public
    function changeQuantity(int $product_id, int $quantity, int $user_id = null): bool
    {
        $this->cart['products'][$product_id] = $quantity;
        return $this->saveCart()->getCart();
    }

    /**
     * @inheritDoc
     */
    protected function setCart(): void
    {
        $this->cart = json_decode($_COOKIE['cart'], true);

    }

    /**
     * @return object
     */
    public function saveCart(): object
    {
        $_COOKIE['cart'] = setcookie('cart', json_encode($this->cart, JSON_UNESCAPED_UNICODE), time() + $this->config['lifeTime']);
        return $this;
    }

}