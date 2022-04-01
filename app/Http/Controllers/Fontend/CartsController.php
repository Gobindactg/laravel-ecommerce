<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\order;
use Auth;

class CartsController extends Controller
{
  public function index()
  {
    return view('pages.cart.carts');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
          'product_id' =>'required'
      ],
      [
          'product_id.required'=>'Please give a product'
      ]);

      if(Auth::check()){
      $cart = Cart::where('user_id', Auth::id())
      ->where('product_id', $request->product_id)
      ->where('order_id', NULl)
      ->first();
      }else{
        $cart = Cart::where('ip_address', $request->ip())
        ->where('product_id', $request->product_id)
        ->where('order_id', NULl)
        ->first();
      }
    //   $cart = Cart::where('ip_address', $request->ip)
    //           ->where('product_id', $request->product_id)
    //           ->first();

            if(!is_null($cart)){
                $cart->increment('product_quantity');
            }else{
                $cart = new Cart();
                if(Auth::guard('web')->check()){
                    $cart->user_id = Auth::id();
                }
                $cart->ip_address = request()->ip();
                $cart->product_id = request()->product_id;
                $cart->save();
    }
    
    session()->flash('success', 'Product has added to cart !!');
    return back();
  }

  public function update(Request $request, $id)
  {
      $cart = Cart::find($id);
      if(!is_null($cart)){
          $cart->product_quantity = $request->product_quantity;
          $cart->save();
      }else{
          return redirect()->route('carts');
      }
      session()->flash('success', 'Product Quantity has Updated Successfully  !!');
      return back();
  }

  public function delete(Request $request, $id)
  {
      $cart = Cart::find($id);
      if(!is_null($cart)){
            $cart->delete();
      }
      session()->flash('success', 'Product  has deleted Successfully  !!');
      return back();
  }
}
