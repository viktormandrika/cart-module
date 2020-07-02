<?php


    namespace models\cart;


    class Cart
    {
        public $cart_id;
        private $user_id;
        private $product_id;
        private $offer_id;

        public function addToCart()
        {

        }

        public function removeFromCart()
        {

        }

        /**
         * @return mixed
         */
        public function getUserId()
        {
            return $this->user_id;
        }

        /**
         * @param mixed $user_id
         */
        public function setUserId($user_id)
        {
            $this->user_id = $user_id;
        }

        /**
         * @return mixed
         */
        public function getProductId()
        {
            return $this->product_id;
        }

        /**
         * @param mixed $product_id
         */
        public function setProductId($product_id)
        {
            $this->product_id = $product_id;
        }

        /**
         * @return mixed
         */
        public function getOfferId()
        {
            return $this->offer_id;
        }

        /**
         * @param mixed $offer_id
         */
        public function setOfferId($offer_id)
        {
            $this->offer_id = $offer_id;
        }

    }