<?php


namespace src\models;


use Illuminate\Database\Eloquent\Model;

/**
 * @property  int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property int $life_time
 */
class CartEloquent extends Model
{

    protected $table = 'cart';
    protected $guarded = [];
    public $timestamps = false;

    /**
     * @param $product_id
     * @param $quantity
     * @param $user_id
     * @param $life_time
     * @return $this
     */
    public function loadModel(int $product_id, int $quantity, int $user_id, int $life_time): object
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->user_id = $user_id;
        $this->life_time = $life_time;
        return $this;

    }

    /**
     * @param $product_id
     * @param $user_id
     * @return bool
     */
    public static function deleteFromCart($product_id, $user_id): bool
    {
        if (self::where('user_id', $user_id)->where('product_id', $product_id)->delete()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $user_id
     * @return bool
     */
    public static function clearCart($user_id): bool
    {
        if (self::where('user_id', $user_id)->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function inCart($product_id, $quantity, $user_id)
    {
        if ($in_cart = CartEloquent::where('product_id', $product_id)->where('user_id', $user_id)->first()) {
            $in_cart->quantity = $quantity;
            if ($in_cart->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function deleteOldCarts()
    {
      return  self::where('life_time', '<', time())->delete();
    }

}