<?php


namespace src\storage;


use src\classes\BaseStorage;

class Session extends BaseStorage
{
    /**
     * @inheritDoc
     */
    public static function getInstance($config): object
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    public function addToCart(int $product_id, int $quantity, $user_id = null): array
    {

        $this->cart['products'][$product_id] = $quantity;
        return $this->saveCart()->getCart();

    }

    /**
     * @return Session
     */
    public function saveCart(): object
    {
        $_SESSION['cart'] = $this->cart;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeFromCart(int $product_id, int $user_id = null): array
    {
        unset($this->cart['products'][$product_id], $_SESSION['cart']['products'][$product_id]);
        return $this->getCart();
    }

    /**
     * @inheritDoc
     */
    public function clearCart(int $user_id = null): array
    {
        unset($_SESSION['cart']['products']);
        return $this->getCart();
    }

    /**
     * @inheritDoc
     *
     */
    public function changeQuantity($product_id, $quantity, int $user_id = null): bool
    {
        $this->cart['products'][$product_id] = $quantity;
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function setCart(): void
    {
        $this->cart = $_SESSION['cart'];
    }


}