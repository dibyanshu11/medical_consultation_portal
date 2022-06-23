<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Consultation;
use App\Models\Doctor;

class CreateConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function consultationIndex()
    {
        return view('admin.add_consultation.index');
    }


    public function doctorList(Request $request)
    {

        $doctors = Doctor::where('office_id', $request->id)->get();
        return response()->json([
            "ReturnCode" => 0,
            "data" =>  $doctors,
        ], 200);
    }



    public function addconsultation()
    {
        $offices = Office::where('user_id', auth()->user()->id)->get()->sortBy('office_name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('office_name', 'id');


        return view('admin.add_consultation.create', compact('offices'));
    }


    public function storeConsultation(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [

                'offices' => 'required',
                'response_name' => 'required',
                'keywords' => 'required',
                'questions' => 'required',
                'phrases' => 'required',
                'video_link' =>  [
                    'required',
                    'url',
                    function ($attribute, $requesturl, $failed) {
                        if (!preg_match('/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/', $requesturl)) {
                            $failed(trans("Please add youtube link", ["name" => trans("general.url")]));
                        }
                    },
                ],
                'video_response' => 'required',


            ],
            [
                 'offices.required' => 'Please Select Office',
                'video_link.required' => 'Please add youtube link',

            ]
        );



        $consultation = new Consultation();
        $consultation->office_id = $request->offices;
        $consultation->doctor_id = $request->doctor_id;
        $consultation->response_name = $request->response_name;
        $consultation->keywords = $request->keywords;
        $consultation->questions = $request->questions;
        $consultation->phrases = $request->phrases;
        $consultation->video_link = $request->video_link;
        $consultation->video_response = $request->video_response;
        $consultation->save();
        return redirect()->route('consultation-index')->with('success', 'Consultation Added Successfully');
    }

    public function  consultaionEdit($id)
    {

        $consultations = Consultation::with('doctor')->with('office')->find($id);

        $selected_doctor = Doctor::find($consultations->doctor_id);

        $doctors_list = Doctor::where('office_id', $consultations->office->id)->get();

        $offices = Office::where('user_id', auth()->user()->id)->get()->sortBy('office_name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('office_name', 'id');

        return view('admin.add_consultation.update', compact('consultations', 'offices', 'selected_doctor', 'doctors_list'));
    }

    public function  doctorUpdate(Request $request, $id)
    {
        $request->validate(
            [

                'offices' => 'required',
                'response_name' => 'required',
                'keywords' => 'required',
                'questions' => 'required',
                'phrases' => 'required',
                'video_link' =>  [
                    'required',
                    'url',
                    function ($attribute, $requesturl, $failed) {
                        if (!preg_match('/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/', $requesturl)) {
                            $failed(trans("Please add youtube link", ["name" => trans("general.url")]));
                        }
                    },
                ],
                'video_response' => 'required',


            ],
            [
                'offices.required' => 'Please Select Office',
                 'video_link.required' => 'Please add youtube link',

            ]
        );

        $updateDoctor = Consultation::where("id", $id)
            ->update([
                "office_id" => $request['offices'],
                "doctor_id" => $request['doctor_id'],
                "response_name" => $request['response_name'],
                "keywords" => $request['keywords'],
                "questions" => $request['questions'],
                "phrases" => $request['phrases'],
                "video_link" => $request['video_link'],
                "video_response" => $request['video_response'],
            ]);

        return redirect()->route('consultation-index')->with('success', 'Consultation Updated Successfully.');
    }


    public function  deleteConsultation($id)
    {

        $deleteConsultation = Consultation::findOrFail($id);
        $deleteConsultation->delete();
        return response()->json(['status' => 'Consultation Deleted Successfully']);
    }
}
