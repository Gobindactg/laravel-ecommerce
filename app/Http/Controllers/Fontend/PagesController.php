<?php

namespace App\Http\Controllers\Fontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;// this function use for data add from database
use App\Models\User;// this function use for data add from database
use App\Models\offerImage;// this function use for data add from database
use App\Models\ClientBlog;// this function use for data add from database
use Image;
use File;

class PagesController extends Controller
{

    
    public function home()
    {
       $offer = offerImage::orderBy('id', 'desc')->get();
       $products = Product::orderBy('id', 'desc')->paginate(4);
       $product = Product::orderBy('id', 'desc')->where('publish_category', '1')->paginate(4);
       $promotion = Product::orderBy('id', 'desc')->where('publish_category', '2')->paginate(4);
       $blogs = ClientBlog::orderBy('id', 'desc')->paginate(4);
      return view('pages.index')->with('product', $product)->with('products', $products)->with('offer', $offer)->with('promotion', $promotion)->with('blogs', $blogs);
      }
    public function contact()
    {
        return view('pages.contact');
      }
    public function product()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('pages.product.index')->with('products', $products);
      }


    public function search(Request $request)
      {
        $search = $request->search;
        $products = Product::orWhere('title', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->orWhere('quantity', 'like', '%' . $search . '%')
        ->orWhere('price', 'like', '%' . $search . '%')
        ->orderBy('id', 'desc')
        ->paginate(4);
          return view('pages.product.search', compact('search', 'products'));
        }

    // update user profile picture
  
    public function blog()
    {
      $blogs = ClientBlog::orderBy('id', 'desc')->paginate(4);
      return view('pages.blog.blog', compact('blogs'));
    }
}
   

