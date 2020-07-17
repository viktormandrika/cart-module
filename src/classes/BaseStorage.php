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
    protected $config;
    /**
     * @var array $cart
     */
    protected $cart;

    /**
     * BaseStorage constructor.
     * @param array $configs
     * @param int|null $user_id
     */
    public function __construct(array $configs, int $user_id = null)
    {
        foreach ($configs as $name => $config) {
            $this->config[$name] = $config;
        }
        $this->setCart($user_id);
    }


    /**
     * @param int $user_id
     * @return void
     */
    abstract protected function setCart(int $user_id = null): void;

    /**
     * @param int|null $user_id
     * @return array

     */
    public function getCart(int $user_id = null): array
    {
        if (!$this->cart) {
            $this->cart = [];
        }
        return $this->cart;
    }


}