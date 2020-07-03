<?php


    namespace src\storage;


    use src\classes\BaseStorage;

    class Session extends BaseStorage
    {
        /**
         * @param $config
         *
         * @return Session
         */
        public static function getInstance($config)
        {
            if (self::$instance === null) {
                self::$instance = new self($config);
            }
            return self::$instance;
        }

        /**
         * @param int $product_id
         * @param int $quantity
         * @param bool $is_ajax
         * @param null $user_id
         *
         * @return bool
         */
        public function addToCart(int $product_id, int $quantity, $is_ajax = false, $user_id = null): bool
        {

            $this->cart['cart']['products'][$product_id] = $quantity;
            if ($is_ajax) {
                $this->jsonGenerate($this->cart);
                $this->saveCart();
            } else {
                $this->saveCart();
            }
            return true;

        }

        /**
         *
         */
        public function saveCart()
        {
            $_SESSION['cart'] = $this->cart;
        }

        /**
         * @param int $product_id
         * @param null $user_id
         *
         * @return bool
         */
        public function removeFromCart(int $product_id, $user_id = null): bool
        {
            unset($_SESSION['cart']['cart']['products'][$product_id]);

        }

        /**
         * @param int|null $user_id
         *
         * @return bool
         */
        public function clearCart(int $user_id = null): bool
        {
            unset($_SESSION['cart']['cart']['products']);
            return true;
        }

        /**
         * @param $product_id
         * @param $quantity
         * @param null $user_id
         *
         * @return bool
         */
        public function changeQuantity($product_id, $quantity, $user_id = null): bool
        {
            $this->cart['cart']['products'][$product_id] = $quantity;
            return true;
        }

        /**
         * @param $user_id
         *
         * @return array|mixed
         */
        public function setCartProducts($user_id)
        {
            $this->cart = $_SESSION['cart'];
            return $this->cart;
        }


    }