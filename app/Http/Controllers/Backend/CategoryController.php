<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category; // this function use for data add from database
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Str; // for use str_slug 
class CategoryController extends Controller
{
  public function category_create()
  {
    $main_categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
    return view('admin.pages.category.create', compact('main_categories'));
  }

  public function category_edit($id)
  {
    $category = Category::find($id);
    $main_categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
    return view('admin.pages.category.edit')->with('category', $category)->with('main_categories', $main_categories);
  }


  public function category_store(Request $request)
  {

    $request->validate(
      [
        'title'   => 'required|max:150',
        'category_image' => 'nullable|image',
      ],
      [
        'title.required' => 'Please enter a category name',
        'category_image.image' => 'Please provide a valid image with .jpg, .png, .jepg extension......',
      ]
    );

    $category = new Category;
    $category->name = $request->title;
    $category->description = $request->description;
    $category->slug = Str::slug($request->title);
    $category->parent_id =  $request->parent_id;

    // productImage model insert single image
    if ($request->hasFile('category_image')) {
      //   //insert that image
      $image = $request->file('category_image');
      $img = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('assets/categoryImage/' . $img);
      Image::make($image)->save($location);
      $category->image = $img;
    }
    $category->save();
    session()->flash('success', 'A new Category has added successfully !!');
    return redirect()->route('admin/category/create');
  }


  public function category_update(Request $request, $id)
  {

    $request->validate(
      [
        'title'   => 'required|max:150',
        'category_image' => 'nullable|image',
      ],
      [
        'title.required' => 'Please enter a category name',
        'category_image.image' => 'Please provide a valid image with .jpg, .png, .jepg extension......',
      ]
    );

    $category = Category::find($id);
    $category->name = $request->title;
    $category->description = $request->description;
    
    $category->parent_id =  $request->parent_id;

    // if(count($request->image > 0)){
    // productImage model insert single image
    if ($request->hasFile('category_image')) {
      // use this for delete old image for update
      if (File::exists('assets/categoryImage/' . $category->image)) {
        File::delete('assets/categoryImage/' . $category->image);
      }
      //   //insert that image
      $image = $request->file('category_image');
      $img = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('assets/categoryImage/' . $img);
      Image::make($image)->save($location);
      $category->image = $img;
    }

    $category->save();
    session()->flash('success', 'Your Category has updated successfully !!');
    return redirect()->route('admin/category/manage');
  }

  public function category_manage()
  {
    $categories = Category::orderBy('id', 'desc')->get();
    return view('admin.pages.category.manage')->with('categories', $categories);
  }
  public function delete($id)
  {
    $category = Category::find($id);  

    if (!is_null($category)) {
    
    // if it is parent category then delete all its sub category
    if($category->parent_id == NULL){
      // delete all sub category

      $sub_categories = Category::orderBy('name', 'desc')->where('parent_id', $category->id)->get();

        foreach ($sub_categories as $sub){
            if (File::exists('assets/categoryImage/' . $sub->image)) {
              File::delete('assets/categoryImage/' . $sub->image);
            }
      $sub->delete();
      }
    }
    if (File::exists('assets/categoryImage/' . $category->image)) {
              File::delete('assets/categoryImage/' . $category->image);
            }
      $category->delete();
    }
    session()->flash('delete', 'Category has deleted successfully !!');
    return back();
  }



  public function category_show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if(!is_null($category)){
            return view('pages.category.search', compact('category'));
        }else{
            session()->flash('errors', 'Sorry !! There is no product by this URL......');
            return redirect()->route('products');
        }
    }
}
