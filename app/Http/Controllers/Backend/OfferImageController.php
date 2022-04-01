<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\offerImage;// this function use for data add from database
use Image;
use File;
class OfferImageController extends Controller
{
    public function offer()
    {
        return view('admin.pages.offer.create');
    }


    public function offer_store(Request $request){

        // $request->validate([
        //   'title'   => 'required|max:150',
        //   'description'   => 'required', 
            
        // ]);
        $offer = new offerImage;
        $offer->title = $request->title;
          // productImage model insert single image
      if ($request->hasFile('offer_image')) {
        //   //insert that image
          $image = $request->file('offer_image');
          $img = time() . '.'. $image->getClientOriginalExtension();
          $location = public_path('assets/offerImage/' .$img);
          Image::make($image)->save($location);
          $offer->image = $img;
      }
      $offer->save();
        return redirect()->route('admin/offer');
      }
}
