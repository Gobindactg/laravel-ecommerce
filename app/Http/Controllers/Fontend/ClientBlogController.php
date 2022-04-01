<?php

namespace App\Http\Controllers\Fontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientBlog;// this function use for data add from database
use Image;
use File;
class ClientBlogController extends Controller
{
      
   
      public function blog_create()
        {
          
          return view('pages.blog.createBlog');
        }

      public function blog_edit($id)
        {
          $blog = ClientBlog::find($id);
          return view('pages.blog.editBlog')->with('blog', $blog);
        }

      public function blog_store(Request $request){

        // $request->validate([
        //   'title'   => 'required|max:150',
        //   'description'   => 'required', 
            
        // ]);
        $blog = new ClientBlog;
        $blog->title = $request->title;
        $blog->description = $request->description;
        
          // productImage model insert single image
      if ($request->hasFile('blog_image')) {
        //   //insert that image
          $image = $request->file('blog_image');
          $img = time() . '.'. $image->getClientOriginalExtension();
          $location = public_path('assets/blogImage/' .$img);
          Image::make($image)->save($location);
          $blog->image = $img;
      }
      $blog->save();
        return redirect()->route('blog');
      }

      
    public function blog_search(Request $request)
       {
        $search = $request->search;
        $blogs = ClientBlog::orWhere('title', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->orWhere('image', 'like', '%' . $search . '%')
        ->orderBy('id', 'desc')
        ->paginate(4);
          return view('pages.blog.search', compact('search', 'blogs'));
        }

    public function blog_update(Request $request, $id)
        {

          // $request->validate([
          //   'title'   => 'required|max:150',
          //   'description'   => 'required',
          //   'price'   => 'required',
          //   'quantity'   => 'required',

          // ]);

          $blog = ClientBlog::find($id);
          $blog->title = $request->title;
          $blog->description = $request->description;
          if ($request->hasFile('blog_image')) {
            // old image delete
             if (File::exists('assets/blogImage/' . $blog->image)) {
                  File::delete('assets/blogImage/' . $blog->image);
                }
                //insert that image
                $image = $request->file('blog_image');
                $img = time() . '.'. $image->getClientOriginalExtension();
                $location = public_path('assets/blogImage/' .$img);
                Image::make($image)->save($location);
                $blog->image = $img;
            }
          $blog->save();
          session()->flash('success', 'Blog has Updated successfully !!');
          return redirect()->route('blog');
        }

  public function blog_delete($id)
  {
    $blog = ClientBlog::find($id);
    if (!is_null($blog)) {
      if (File::exists('assets/blogImage/' . $blog->image)) {
                  File::delete('assets/blogImage/' . $blog->image);
                }
      $blog->delete();
    }
    session()->flash('delete', 'Blog has deleted successfully !!');
    return redirect()->route('blog');
  }

 }
