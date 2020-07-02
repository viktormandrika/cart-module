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
        public function setConfig($config)
        {
            $this->config = $config;
            $this->storage = new $this->config['storage']($config);
        }

        /**
         * @param int $product_id
         * @param int $quantity
         * @param int $cart_id
         * @param int $user_id
         */
        public function addToCart($product_id, $quantity, $cart_id = null, $user_id = null)
        {
            if (!$this->storage->addToCart($product_id, $quantity, $cart_id, $user_id)) {
                throw new \InvalidArgumentException('Error');
            }

        }

        /**
         * @param int $product_id
         * @param int $cart_id
         *
         * @return boolean
         */
        public function removeFromCart($product_id, $cart_id = null)
        {
            return $this->storage->removeFromCart($product_id, $cart_id);

        }

        /**
         * @param int $cart_id
         *
         * @return boolean
         */

        public function clearCart($cart_id = null)
        {
            return $this->storage->clearCart($cart_id);

        }

        /**
         * @param int $product_id
         * @param int $quantity
         * @param int $cart_id
         */
        public function changeQuantity($product_id, $quantity, $cart_id = null)
        {
            $this->storage->changeQuantity($product_id, $quantity, $cart_id = null);
        }
    }