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
        public $cart;

        public function __construct($configs, $user_id = null)
        {
            foreach ($configs as $name => $config) {
                $this->config[$name] = $config;
            }

            $this->cart = $this->setCartProducts($user_id);

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
         */
        public function jsonCartResponse($user_id = null): void
        {
            echo $this->jsonGenerate($this->cart);
        }

        /**
         * @param  $cart
         *
         * @return false|string
         */
        protected function jsonGenerate($cart)
        {
            return json_encode($cart);
        }


    }