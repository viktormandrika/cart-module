<?php


    namespace src\storage;


    use src\classes\BaseStorage;

    class Cookie extends BaseStorage
    {
        /**
         * @param array $config
         *
         * @return Cookie
         */
        public static function getInstance($config): object
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
         * @param int $user_id
         *
         * @return bool
         */
        public function addToCart(int $product_id, int $quantity, $is_ajax = false, $user_id = null): bool
        {

                $this->cart['cart']['products'][$product_id] = $quantity;
                if ($is_ajax) {
                    $this->jsonGenerate($this->cart);
                } else {
                    $this->setCookieCart();
                }
                return true;


        }

        /**
         * @param $cart
         *
         * @return false|string
         */

        private function setCookieCart(): bool
        {
            if (setcookie('cart', $this->jsonGenerate($this->cart), time() + $this->config['lifeTime'])) {
                return true;
            }
        }

        /**
         * @param int $product_id
         * @param int $cart_id
         *
         * @return bool
         */
        public
        function removeFromCart(int $product_id, $cart_id = null): bool
        {

            unset($this->cart['cart']['products'][$product_id]);
            setcookie('cart', json_encode($this->cart, JSON_UNESCAPED_UNICODE), time() + $this->config['lifeTime']);
            return true;

        }


        /**
         * @param int $user_id
         *
         * @return bool
         */
        public
        function clearCart(int $user_id = null): bool
        {
            if (setcookie('cart', false)) {
                return true;
            } else {
                throw new \InvalidArgumentException('Не удалось очистить корзину');
            }

        }

        /**
         * @param $product_id
         * @param $quantity
         * @param null $cart_id
         *
         * @return bool
         */
        public
        function changeQuantity($product_id, $quantity, $cart_id = null): bool
        {
            if ($cart = json_decode($_COOKIE['cart'], true)) {
                $cart['cart']['products'][$product_id] = $quantity;
                $this->cart = $cart;
                setcookie('cart', json_encode($cart, JSON_UNESCAPED_UNICODE), time() + $this->config['lifeTime']);
                return true;
            } else {
                return false;
            }
        }

        /**
         * @param null $user_id
         *
         * @return array|mixed
         */
        public function setCartProducts($user_id = null)
        {
            $this->cart = json_decode($_COOKIE['cart'], true);
            return $this->cart;


        }


    }