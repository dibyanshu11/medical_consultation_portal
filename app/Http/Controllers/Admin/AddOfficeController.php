<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\USState;
use App\Models\Office;

class AddOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function officeIndex()
    {
      
        return view('admin.add_office.index');
    }

    public function createOffice()
    {
        $states = USState::get()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name','name');
        return view('admin.add_office.create', compact('states'));
    }

    public function storeOffice(Request $request)
    {

        $request->validate([
            'office_name' => 'required',
            'address' => 'required',
            'city' => 'required|string',
            'state' => 'required',
            'zip_code' => 'required|numeric',
        ]);

        $office = new Office;
        $office->user_id = auth()->user()->id;
        $office->office_name = $request->office_name;
        $office->address = $request->address;
        $office->city = $request->city;
        $office->state = $request->state;
        $office->zip_code = $request->zip_code;
        $office->save();
        return redirect()->route('office-index')->with('success', 'Office Added Successfully');
        
    }




    public function  officeEdit($id)
    {
       
        $offices = Office::find($id);
        $states = USState::get()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name','name');

        return view('admin.add_office.update', compact('offices', 'states'));
    }

    public function  officeUpdate(Request $request, $id)
    {

        $updateOffice = Office::where("id", $id)
            ->update([
                "office_name" => $request['office_name'],
                "address" => $request['address'],
                "state" => $request['state'],         
                "city" => $request['city'],
                "zip_code" => $request['zip_code']
            ]);
        
        return redirect()->route('office-index')->with('success', 'Office Updated Successfully');
    }



    public function deleteOffice($id)
    {
        $deleteOffice = Office::findOrFail($id);
        $deleteOffice->delete();
        return response()->json(['status' => 'Office Deleted Successfully']);
    }
}
