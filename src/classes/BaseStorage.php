<?php

namespace src\classes;

use src\interfaces\StorageInterface;

abstract class BaseStorage implements StorageInterface
{
    /**
     * @var StorageInterface $instance
     */
    public static $instance;
    /**
     * @var array $config
     */
    public $config;
    /**
     * @var array $cart
     */
    protected $cart;

    public function __construct($configs, $user_id = null)
    {
        foreach ($configs as $name => $config) {
            $this->config[$name] = $config;
        }
        $this->setCart();
    }

    /**
     * @return mixed
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param null $user_id
     *
     * @return string
     */
    public function jsonCartResponse($user_id = null): string
    {
        return $this->jsonGenerate($this->cart);
    }

    /**
     * @param $cart
     * @return string
     */
    protected function jsonGenerate($cart): string
    {
        return json_encode($cart);
    }

    /**
     * @return void
     */
    abstract protected function setCart(): void;

}