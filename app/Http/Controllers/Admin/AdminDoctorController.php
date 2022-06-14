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


        return view('admin.add_doctor.index');
    }

    public function  addDoctor()
    {

        $officeSelect = Office::where('user_id', auth()->user()->id)->get()->sortBy('office_name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('office_name', 'id');
        return view('admin.add_doctor.create', compact('officeSelect'));
    }


    public function  storeDoctor(Request $request)
    {

        // dd($request->all());
        $request->validate([

            'offices' => 'required',
            'image' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'practice' => 'required',
            'intro_video' =>  [
                'required',
                'url',
                function ($attribute, $requesturl, $failed) {
                    if (!preg_match('/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/', $requesturl)) {
                        $failed(trans("general.not_youtube_url", ["name" => trans("general.url")]));
                    }
                },
            ],
            'description' => 'required',

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
        $doctor->full_name = $request->first_name . ' ' . $request->last_name;
        $doctor->practice = $practice;
        $doctor->intro_video = $request->intro_video;
        $doctor->description = $request->description;
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

        $request->validate([
            'offices' => 'required',
          
            'first_name' => 'required',
            'last_name' => 'required',
            'practice' => 'required',
            'description' => 'required',
            'intro_video' =>  [
                'required',
                'url',
                function ($attribute, $requesturl, $failed) {
                    if (!preg_match('/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/', $requesturl)) {
                        $failed(trans("general.not_youtube_url", ["name" => trans("general.url")]));
                    }
                },
            ],

            

        ]);

        $all = $request->all();
        if (!empty($request->cropimage)) {

            $data = $request->cropimage;

            list($type, $data) = explode(';', $data);

            list(, $data) = explode(',', $data);

            $data = base64_decode($data);

            $image_name = time() . '.png';

            $path = public_path() . "/storage/doctor-profile/" . $image_name;

            file_put_contents($path, $data);
        }
        $office = Office::where('id', $request->offices)->first();
        $practice = implode(", ", $request->practice);
        $data = [];
        if (!empty($image_name)) {
            $data = ["doctor_pic" =>  $image_name];
        }
        $data = array_merge([
            "office_id" => $request['offices'],
            "office_name" => $office->office_name,
            "first_name" => $request['first_name'],
            "last_name" => $request['last_name'],
            "full_name" => $request['first_name'] . ' ' . $request['last_name'],
            "practice" => $practice,
            "intro_video" => $request['intro_video'],
            "description" => $request['description'],
        ], $data);

        $updateDoctor = Doctor::where("id", $id)
            ->update($data);

        return redirect()->route('doctor-index')->with('success', 'Doctor Updated Successfully.');
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
}
