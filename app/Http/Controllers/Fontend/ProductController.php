<?php

namespace App\Http\Controllers\Fontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;// this function use for data add from database
use App\Models\ProductImage;
use Image;
class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if(!is_null($product)){
            return view('pages.product.single', compact('product'));
        }else{
            session()->flash('errors', 'Sorry !! There is no product by this URL......');
            return redirect()->route('products');
        }
    }
}
