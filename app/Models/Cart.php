<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    public $fillable = 
    [
        'user_id',
        'product_id',
        'order_id',
        'ip_address',
        'product_quantity'
      
    ];
public function user()
    {
        return $this->belongsTo(User::class);
    }
public function order()
    {
        return $this->belongsTo(Order::class);
    }
public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function totalItem()
    {
        if(Auth::check()){
            $cart = Cart::where('user_id', Auth::id())
            ->where('order_id', NULL)
            ->get();
        }else{
            $cart = Cart::where('ip_address', request()->ip())->where('order_id', NULL)->get();
        }
        $total_item = 0;
        foreach ($cart as $cart) {
           $total_item += $cart->product_quantity;
        }
        return $total_item;
    }


    public static function totalCarts()
    {
        if(Auth::check()){
            $cart = Cart::where('user_id', Auth::id())
            ->where('order_id', NULL)
            ->get();
        }else{
            $cart = Cart::where('ip_address', request()->ip())->where('order_id', NULL)->get();
        }
     
        return $cart;
    }

    
}
