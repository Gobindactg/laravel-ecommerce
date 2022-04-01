<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Division; // this function use for data add from database
use Illuminate\Http\Request;

use Illuminate\Support\Str; // for use str_slug 
class DivisionController extends Controller
{
  public function division_create()
  {
    $division = Division::orderBy('name', 'desc')->get();
    return view('admin.pages.division.create', compact('division'));
  }
  
  public function division_store(Request $request)
  {

    $request->validate(
      [
        'title'   => 'required|max:150',
        'priority' => 'required',
      ],
      [
        'title.required' => 'Please enter a division name',
        'priority' => 'Please provide Priority Number',
      ]
    );

    $division = new Division;
    $division->name = $request->title;
    $division->priority = $request->priority;
   
    $division->save();
    session()->flash('success', 'A new Division has added successfully !!');
    return redirect()->route('admin/division/create');
  }
  public function division_manage()
  {
    $division = Division::orderBy('id', 'desc')->get();
    return view('admin.pages.division.manage')->with('division', $division);
  }


  public function division_edit($id)
  {
    $division = Division::find($id);
   
    return view('admin.pages.division.edit')->with('division', $division);
  }


 
  public function division_update(Request $request, $id)
  {

    $request->validate(
      [
        'title'   => 'required|max:150',
        'priority' => 'required',
      ],
      [
        'title.required' => 'Please enter a division name',
        'priority' => 'Please provide Priority Number',
      ]
    );

    $division = Division::find($id);
    $division->name = $request->title;
    $division->priority = $request->priority;
   
    $division->save();
    session()->flash('success', ' Division Update has added successfully !!');
    return redirect()->route('admin/division/manage');
  }


  public function delete($id)
  {
    $division = Division::find($id);  

    if (!is_null($division)) {
      $division->delete();
    }
    session()->flash('delete', 'Division has deleted successfully !!');
    return back();
  }


}
