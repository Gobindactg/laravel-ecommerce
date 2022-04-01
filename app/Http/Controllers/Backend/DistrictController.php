<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\District; // this function use for data add from database
use App\Models\Division; // this function use for data add from database
use Illuminate\Http\Request;

use Illuminate\Support\Str; // for use str_slug 
class DistrictController extends Controller
{
  public function district_create()
  {
    $division = Division::orderBy('name', 'desc')->get();
    return view('admin.pages.district.create', compact('division'));
  }
  
  public function district_store(Request $request)
  {

    $request->validate(
      [
        'title'   => 'required|max:150',
        'division_id' => 'required',
      ],
      [
        'title.required' => 'Please enter a district name',
        'division_id' => 'Please provide Division Name',
      ]
    );

    $district = new District;
    $district->name = $request->title;
    $district->division_id = $request->division_id;
   
    $district->save();
    session()->flash('success', 'A new District has added successfully !!');
    return redirect()->route('admin/district/create');
  }
  public function district_manage()
  {
    $district = District::orderBy('id', 'desc')->get();
    return view('admin.pages.district.manage')->with('district', $district);
  }


  public function district_edit($id)
  {
    $district = District::find($id);
   
    return view('admin.pages.district.edit')->with('district', $district);
  }


 
  public function district_update(Request $request, $id)
  {

    $request->validate(
      [
        'title'   => 'required|max:150',
        'priority' => 'required',
      ],
      [
        'title.required' => 'Please enter a District name',
        'priority' => 'Please provide Priority Number',
      ]
    );

    $district = District::find($id);
    $district->name = $request->title;
    $district->priority = $request->priority;
   
    $district->save();
    session()->flash('success', ' district Update has added successfully !!');
    return redirect()->route('admin/district/manage');
  }


  public function delete($id)
  {
    $district = District::find($id);  

    if (!is_null($district)) {
      $district->delete();
    }
    session()->flash('delete', 'District has deleted successfully !!');
    return back();
  }


}
