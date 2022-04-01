<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Admin;
use App\Models\Product; // this function use for data add from database
use App\Models\ProductImage;
use App\Models\Brand;
use App\Models\Category;
use File;
use Image;
use Illuminate\Support\Str; // for use str_slug 

use Illuminate\Http\Request;

class AdminProductController extends Controller
{

 
  // public function __construct()
  // {
  //     $this->middleware('admin')->except('logout');
      
  // }
  public function create()
  {
    $brand = Brand::orderBy('id', 'desc')->get();
    // $category = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
    // $child_category = Category::orderBy('id', 'desc')->where('parent_id')->get();
    return view('admin.pages.product.create')->with('brand', $brand);
  }

  public function manage()
  {
    $products = Product::orderBy('id', 'desc')->get();
    return view('admin.pages.product.manage')->with('products', $products);
  }

  public function edit($id)
  {
    $product = Product::find($id);
    $category = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
    // $main_categories = Category::orderBy('name', 'desc')->where('parent_id', $parent->id)->get();
    $main_brand = Brand::orderBy('name', 'desc')->get();
    return view('admin.pages.product.edit')->with('product', $product)->with('main_brand', $main_brand)->with('category', $category);
  }

  public function product_store(Request $request)
  {

    $request->validate([
      'title'   => 'required|max:150',
      'description'   => 'required',
      'price'   => 'required',
      'quantity'   => 'required',

    ]);


    $product = new Product;
    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->slug = Str::slug($request->title);
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->publish_category = $request->publish_category;
    $product->admin_id = 1;
    $product->save();


    // // productImage model insert single image
    // if ($request->hasFile('product_image')) {
    //   //   //insert that image
    //   $image = $request->file('product_image');
    //   $img = time() . '.' . $image->getClientOriginalExtension();
    //   $location = public_path('images/' . $img);
    //   Image::make($image)->save($location);

    //   $product_image = new ProductImage;
    //   $product_image->product_id = $product->id;
    //   $product_image->image = $img;
    //   $product_image->save();
    // }

    if(count($request->product_image) > 0){
      foreach ($request->product_image as $image){
      $img = time() . '.'. $image->getClientOriginalExtension();
      $location = public_path('images/' . $img);
      Image::make($image)->save($location);

      $product_image = new ProductImage;
      $product_image->product_id = $product->id;
      $product_image->image = $img;
      $product_image->save();
      }
    }


    return redirect()->route('admin/create');
  }
  public function product_update(Request $request, $id)
  {

    $request->validate([
      'title'   => 'required|max:150',
      'description'   => 'required',
      'price'   => 'required',
      'quantity'   => 'required',

    ]);


    $product = Product::find($id);
    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;

    $product->save();

    // if(count($request->product_image) > 0){
    //   foreach ($request->product_image as $image){
    //   $img = time() . '.'. $image->getClientOriginalExtension();
    //   $location = public_path('images/' . $img);
    //   Image::make($image)->save($location);

    //   $product_image = ProductImage::find($id);
    //   $product_image->product_id = $product->id;
    //   $product_image->image = $img;
    //   $product_image->save();
    //   }
    // }
    return redirect()->route('admin/manage');
  }

  public function delete($id)
  {
    $product = Product::find($id);
    if (!is_null($product)) {
      $product->delete();
    }
    session()->flash('success', 'Product has deleted successfully !!');
    return back();
  }
}
