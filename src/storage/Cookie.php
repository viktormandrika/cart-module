<?php


    namespace src\storage;


    use src\classes\BaseStorage;

    class Cookie extends BaseStorage
    {

        /**
         * @param int $product_id
         * @param int $quantity
         * @param int $cart_id
         * @param int $user_id
         *
         * @return bool
         */
        public function addToCart(int $product_id, int $quantity, $cart_id = null, $user_id = null): bool
        {

            if ($_COOKIE['cart']) {
                $cart = json_decode($_COOKIE['cart'], true);
            } else {
                $cart['cart'] = [];
            }
            $cart['cart']['products'][$product_id] = $quantity;
            if (setcookie('cart', json_encode($cart, JSON_UNESCAPED_UNICODE), time() + $this->config['lifeTime'])) {
                return true;
            } else {
                throw new \InvalidArgumentException('Не удалось добавить в корзину');
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

            if ($cart = json_decode($_COOKIE['cart'], true)) {
                unset($cart['cart']['products'][$product_id]);
                setcookie('cart', json_encode($cart, JSON_UNESCAPED_UNICODE), time() + $this->config['lifeTime']);
            }

            return true;
            // TODO: Implement removeFromCart() method.
        }

        /**
         * @param int $cart_id
         *
         * @return bool
         */
        public
        function clearCart(int $cart_id): bool
        {
            if (setcookie('cart', false)) {
                return true;
            } else {
                throw new \InvalidArgumentException('Не удалось очистить корзину');
            }

        }

        public
        function changeQuantity($product_id, $quantity, $cart_id = null): bool
        {
            if ($cart = json_decode($_COOKIE['cart'], true)) {
                $cart['cart']['products'][$product_id] = $quantity;
                setcookie('cart', json_encode($cart, JSON_UNESCAPED_UNICODE), time() + $this->config['lifeTime']);
                return true;
            } else {
                return false;
            }
        }
    }