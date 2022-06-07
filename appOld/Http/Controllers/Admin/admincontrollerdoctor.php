<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminDoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function doctorIndex(Request $request)
    {
        $office_details = Office::where('user_id', auth()->user()->id)->get()->pluck('id', 'office_name');

        $doctors = Doctor::whereIn('office_id', $office_details)->orderBy('id', 'DESC')->get();

        return view('admin.add_doctor.index', compact('doctors'));
  
    }

    public function  addDoctor()
    {

        $officeSelect = Office::where('user_id', auth()->user()->id)->get()->sortBy('office_name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('office_name', 'id');
        return view('admin.add_doctor.create', compact('officeSelect'));
    }

   
    public function  storeDoctor(Request $request)
    {

        $request->validate([

            'offices' => 'required',
            'image' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'practice' => 'required'
        ]);

        if (!empty($request->cropimage)) {

            $data = $request->cropimage;

            list($type, $data) = explode(';', $data);

            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);

            $image_name = time() . '.png';

            $path = public_path() . "/storage/doctor-profile/" . $image_name;

            file_put_contents($path, $data);
        } else if ($request->hasfile('image')) {
            $image_name = time() . rand(1, 100) . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path("/storage/doctor-profile/"),  $image_name);
        }

        $office = Office::where('id', $request->offices)->first();

        $practice = implode(", ", $request->practice);

        $doctor = new Doctor;
        $doctor->office_id = $request->offices;
        $doctor->office_name = $office->office_name;
        $doctor->doctor_pic = $image_name;
        $doctor->first_name = $request->first_name;
        $doctor->last_name = $request->last_name;
        $doctor->practice = $practice;
        $doctor->save();
        session()->flash('success', 'Doctor Added Successfully');
        return redirect()->route('doctor-index');
    }


    public function  doctorEdit($id)
    {

        $doctors = Doctor::find($id);
        $officeSelect = Office::where('user_id', auth()->user()->id)->get()->sortBy('office_name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('office_name', 'id');
        return view('admin.add_doctor.update', compact('doctors', 'officeSelect'));
    }

    public function  doctorUpdate(Request $request, $id)
    {
        $all = $request->all();
        $image_name = $request->doctor_pic;
        if (!empty($request->cropimage)) {

            $data = $request->cropimage;

            list($type, $data) = explode(';', $data);

            list(, $data) = explode(',', $data);

            $data = base64_decode($data);

            $image_name = time() . '.png';

            $path = public_path() . "/storage/doctor-profile/" . $image_name;

            file_put_contents($path, $data);
        } else if ($request->hasfile('image')) {

            if ($request->file('image')) {
                $file = $request->file('image');
                $path = public_path('storage/doctor-profile/');
                $fileType = $file->getMimeType();
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = time() . $fileExtension;
                $check = $file->move($path, $fileName);
                if ($check) {
                    $image_name = $fileName;
                }
            }
        }


        $office = Office::where('id', $request->offices)->first();
        $practice = implode(", ", $request->practice);
        $updateDoctor = Doctor::where("id", $id)
            ->update([
                "office_id" => $request['offices'],
                "office_name" => $office->office_name,
                "doctor_pic" =>  $image_name,
                "first_name" => $request['first_name'],
                "last_name" => $request['last_name'],
                "practice" => $practice,

            ]);

        // session()->flash('success', 'Doctor Updated Successfully.');

        // $office_details = Office::where('user_id', auth()->user()->id)->get()->pluck('id', 'office_name');
        // $doctors = Doctor::whereIn('office_id', $office_details)->orderBy('id', 'DESC')->paginate(10);

        return redirect()->route('doctor-index')->with('success', 'Doctor Updated Successfully.');
        // return view('admin.add_doctor.index', compact('doctors'));
    }


    public function  deleteDotor($id)
    {
        $deleteOffice = Doctor::findOrFail($id);
        $deleteOffice->delete();
        return response()->json(['status' => 'Doctor Deleted Successfully']);
        return view('admin.add_doctor.index');
    }


    public function uploadDoctorPhoto(Request $request)
    {

        if ($request->image) {

            $data = $request->image;

            list($type, $data) = explode(';', $data);

            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);

            $image_name = time() . '.png';

            $path = public_path() . "/storage/doctor-profile/" . $image_name;

            file_put_contents($path, $data);

            Doctor::where(['id' => $request->doctor_id])

                ->update([

                    'doctor_pic' => $image_name

                ]);
        }

        return response()->json(['success' => 'success']);
    }


    public function  searchDoctor(Request $request)
    {
        if(isset($request->search ) ){
            $office_details = Office::where('user_id', auth()->user()->id)->get()->pluck('id', 'office_name');
            $doctor = Doctor::select('doctors.*',DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))->whereIn('office_id', $office_details)->where('first_name','LIKE','%'.$request->search.'%')
            ->orWhere('last_name','LIKE','%'.$request->search.'%')->orderBy('id', 'DESC')->get();
        }else{
            $office_details = Office::where('user_id', auth()->user()->id)->get()->pluck('id', 'office_name');
            $doctor = Doctor::select('doctors.*', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))->whereIn('office_id', $office_details)->orderBy('id', 'DESC')->get();
           
        }
        return response()->json($doctor);
        // echo "<pre>";
        // print_r($request->all());die;

        //return "helooooo search doctor";
        // $doctors = Doctor::find($id);
        // $officeSelect = Office::where('user_id', auth()->user()->id)->get()->sortBy('office_name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('office_name', 'id');
        // return view('admin.add_doctor.update', compact('doctors', 'officeSelect'));
    }
}
