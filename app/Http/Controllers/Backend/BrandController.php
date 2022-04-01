<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
use File;
class BrandController extends Controller
{
   public function brand_manage()
    {
        $brand = Brand::orderBy('name', 'desc')->get();
        return view('admin.pages.brand.manage', compact('brand'));
    }
   public function brand_create()
    {
        return view('admin.pages.brand.create');
    } 

   public function brand_store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->title;
        $brand->description = $request->description;
        // insert brand image
        if($request->hasFile('brand_image'))
        {
            $image = $request->file('brand_image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('assets/brandImage/'.$img);
            Image::make($image)->save($location);
            $brand->image = $img;
        }
        $brand->save();
        session()->flash('success', 'A new Brand has added successfully !!');
        return redirect()->route('admin/brand/create');
    } 
    public function brand_edit($id)
        {
            $brand = Brand::find($id);
            return view('admin.pages.brand.edit')->with('brand', $brand);
        }

  public function brand_update(Request $request, $id)
  {

    $request->validate(
      [
        'title'   => 'required|max:150',
        'brand_image' => 'nullable|image',
      ],
      [
        'title.required' => 'Please enter a brand name',
        'brand_image.image' => 'Please provide a valid image with .jpg, .png, .jepg extension......',
      ]
    );

    $brand = Brand::find($id);
    $brand->name = $request->title;
    $brand->description = $request->description;

    // if(count($request->image > 0)){
    // productImage model insert single image
    if ($request->hasFile('brand_image')) {
      // use this for delete old image for update
      if (File::exists('assets/brandImage/' . $brand->image)) {
        File::delete('assets/brandImage/' . $brand->image);
      }
      //   //insert that image
      $image = $request->file('brand_image');
      $img = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('assets/brandImage/' . $img);
      Image::make($image)->save($location);
      $brand->image = $img;
    }

    $brand->save();
    session()->flash('success', 'Your Brand has updated successfully !!');
    return redirect()->route('admin/brand/manage');
  }

//   public function category_manage()
//   {
//     $categories = Category::orderBy('id', 'desc')->get();
//     return view('admin.pages.category.manage')->with('categories', $categories);
//   }
//   public function delete($id)
//   {
//     $category = Category::find($id);  

//     if (!is_null($category)) {
    
//     // if it is parent category then delete all its sub category
//     if($category->parent_id == NULL){
//       // delete all sub category

//       $sub_categories = Category::orderBy('name', 'desc')->where('parent_id', $category->id)->get();

//         foreach ($sub_categories as $sub){
//             if (File::exists('assets/categoryImage/' . $sub->image)) {
//               File::delete('assets/categoryImage/' . $sub->image);
//             }
//       $sub->delete();
//       }
//     }
//     if (File::exists('assets/categoryImage/' . $category->image)) {
//               File::delete('assets/categoryImage/' . $category->image);
//             }
//       $category->delete();
//     }
//     session()->flash('delete', 'Category has deleted successfully !!');
//     return back();
//   }
}
