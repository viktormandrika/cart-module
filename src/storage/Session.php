<?php


namespace src\storage;


use src\classes\BaseStorage;

/**
 * Class Session
 * @property array $config
 * @property array $cart
 */
class Session extends BaseStorage
{
    /**
     * Session constructor.
     * @param array $configs
     * @param int|null $user_id
     * @propert
     */
    public function __construct(array $configs, int $user_id = null)
    {
        parent::__construct($configs, $user_id);
        if (session_status() != 2) {
            session_start();
        }
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
     * @return bool
     */
    private function saveCart(): bool
    {
        if ($_SESSION['cart'] = $this->cart) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function removeFromCart(int $product_id, int $user_id = null): bool
    {
        if (isset($this->cart['products'][$product_id])) {
            unset($this->cart['products'][$product_id]);
            return $this->saveCart();
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function clearCart(int $user_id = null): bool
    {
        if (isset($this->cart['products'])) {
            unset($this->cart['products'], $_SESSION['cart']['products']);
            return $this->saveCart();
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getCart(int $user_id = null): array
    {
        return $this->cart;
    }

    /**
     * @param int|null $user_id
     */
    protected function setCart(int $user_id = null): void
    {
        if (isset($_SESSION['cart'])) {
            $this->cart = $_SESSION['cart'];
        } else {
            $this->cart = [];
        }
    }

}