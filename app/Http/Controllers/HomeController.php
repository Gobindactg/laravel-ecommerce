<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;// this function use for data add from database
use App\Models\offerImage;// this function use for data add from database
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $offer = offerImage::orderBy('id', 'desc')->get();
        $products = Product::orderBy('id', 'desc')->paginate(4);
       return view('pages.index')->with('products', $products)->with('offer', $offer);
        
    }
}
