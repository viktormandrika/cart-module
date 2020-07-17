<?php


namespace src\storage;


use src\classes\BaseStorage;
use src\models\CartEloquent;

/**
 * Class DBEloquent
 * @property array $cart
 */
class DBEloquent extends BaseStorage
{

    public function __construct(array $configs, int $user_id = null)
    {
        parent::__construct($configs, $user_id);
        $this->setCart($user_id);
    }

    /**
     * @inheritDoc
     */
    public static function getInstance(array $config, int $user_id = null): object
    {
        if (self::$instance === null) {
            self::$instance = new self($config, $user_id);
        }
        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    protected function setCart(int $user_id = null): void
    {

        $this->cart['products'] = CartEloquent::where('user_id', $user_id)->get();
    }

    /**
     * @inheritDoc
     */
    public function addToCart(int $product_id, int $quantity, int $user_id = null): bool
    {
        $cart = new CartEloquent();
        if ($cart->inCart($product_id, $quantity, $user_id)) {
            return true;
        } else {
            if ($cart->loadModel($product_id, $quantity, $user_id, time() + $this->config['lifeTime'])->save()) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function removeFromCart(int $product_id, int $user_id = null): bool
    {
        return CartEloquent::deleteFromCart($product_id, $user_id);
    }

    /**
     * @inheritDoc
     */
    public function clearCart(int $user_id = null): bool
    {
        return CartEloquent::clearCart($user_id);
    }
}