<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Consultation;
use App\Models\User;
use App\Models\Chat;
use App\Models\ChatData;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DoctorController extends Controller
{
    public function doctorList(Request $request)
    {

        $doctors  = [];

        if (isset($request->search) && !empty($request->search) && isset($request->practice) && !empty($request->practice)) {
            $doctors = Doctor::where("status", "active")->whereRaw("concat(first_name, ' ', last_name) like '%" . $request->search . "%' ")->whereRaw("concat(practice) like '%" . $request->practice . "%' ");
        }

        if ($request->search) {
            $doctors  = Doctor::where("status", "active")->whereRaw("concat(first_name, ' ', last_name) like '%" . $request->search . "%' ");
        }

        if ($request->practice) {
            if (empty($doctors)) {
                $doctors = Doctor::where("status", "active")->whereRaw("concat(practice) like '%" . $request->practice . "%' ");
            } else {
                $doctors = $doctors->where("status", "active")->whereRaw("concat(practice) like '%" . $request->practice . "%' ");
            }
        }

        if (!empty($doctors)) {
            $doctors = $doctors->get();
        } else {
            $doctors = Doctor::get();
        }

        return response()->json([
            "ReturnCode" => 1,
            "ReturnMessage" => "doctors List.",
            "data" =>  $doctors,

        ], 200);
    }


    public function doctorConsultation(Request $request)
    {

        try {
            $consultation  = [];

            if (isset($request->search) && !empty($request->search) && isset($request->doctor_id) && !empty($request->doctor_id)) {

                $consultation = Consultation::query();
                $columns = ['keywords', 'questions', 'phrases'];
                $consultation->with('doctor');
                foreach ($columns as $column) {
                    $consultation->orWhere($column, 'LIKE', '%' . $request->search . '%')->where('doctor_id', $request->doctor_id);
                }
                $consultation = $consultation->get();
            } else {
                return response()->json([
                    "ReturnCode" => 0,
                    "messsage" => "Please check parameters both doctor_id and search are required"
                ], 400);
            }

            try {

                if ($request->chat_id == 0) {


                    //insert data in chat table
                    $create_chat = new Chat;
                    $create_chat->user_id = Auth::user()->id;
                    $create_chat->doctor_id = $request->doctor_id;
                    $create_chat->save();

                    //insert data in chatData table
                    $save_chat_data = new ChatData;
                    if ($request->has('audio')) {

                        $music_file = $request->file('audio');

                        $filename = $music_file->getClientOriginalName();
                        $location = public_path('/storage/user-audio/');
                        $music_file->move($location, $filename);

                        $save_chat_data->audio = $filename;
                    }

                    if (!isset($consultation[0])) {
                        $save_chat_data->chat_data = "No Result Found.";
                    } else {
                        $save_chat_data->chat_data = json_encode($consultation);
                    }

                    $save_chat_data->chat_id = $create_chat->id;
                    $save_chat_data->key = $request->search;
                    $save_chat_data->save();

                    if ($request->has('audio')) {
                        return response()->json([
                            "ReturnCode" => 1,
                            "data" => $consultation,
                            "SearchKey" => $request->search,
                            "audio" => $filename,
                            "chat_id" => $create_chat->id,
                        ], 200);
                    } else {
                        return response()->json([
                            "ReturnCode" => 1,
                            "data" => $consultation,
                            "SearchKey" => $request->search,

                            "chat_id" => $create_chat->id,
                        ], 200);
                    }
                } else {

                    //first check chat is already exists

                    $chat = Chat::where('id', $request->chat_id)->where('doctor_id', $request->doctor_id)->count();

                    $save_chat_data = new ChatData;
                    if ($chat >= 1) {
                        if (!isset($consultation[0])) {
                            $save_chat_data->chat_data = "No Result Found.";
                        } else {
                            $save_chat_data->chat_data  = json_encode($consultation);
                        }

                        if ($request->has('audio')) {

                            $music_file = $request->file('audio');

                            $filename = $music_file->getClientOriginalName();
                            $location = public_path('/storage/user-audio/');
                            $music_file->move($location, $filename);

                            $save_chat_data->audio = $filename;
                        }

                        $save_chat_data->chat_id = $request->chat_id;
                        $save_chat_data->key = $request->search;
                        $save_chat_data->save();
                    } else {
                        return "please check chat id or doctor id";
                    }

                 


                    if ($request->has('audio')) {
                        return response()->json([
                            "ReturnCode" => 1,
                            "data" => $consultation,
                            "SearchKey" => $request->search,
                            "audio" => $filename,

                        ], 200);
                    } else {
                        return response()->json([
                            "ReturnCode" => 1,
                            "data" => $consultation,
                            "SearchKey" => $request->search,
                        ], 200);
                    }
                }
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    "ReturnCode" => 0,
                    "ReturnMessage" => "Please try again and check payload.",
                    "error" => $e
                ], 400);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "ReturnCode" => 0,
                "ReturnMessage" => "Please try again and check payload.",
                "error" => $e
            ], 400);
        }
    }

    public function endChat(Request $request)
    {

        $check_chat_exist = Chat::where('id', $request->chat_id)->where('user_id', Auth::user()->id)->count();
        if ($check_chat_exist > 0) {

            $update_end_chat_status = Chat::where('id', $request->chat_id)
                ->where('user_id', Auth::user()->id)
                ->update([
                    'status' => "1",
                ]);

            return response()->json([
                "ReturnCode" => 1,
                "data" => "chat update successfully.",
            ], 200);
        } else {
            return response()->json([
                "ReturnCode" => 0,
                "ReturnMessage" => "Chat not found with Id ." . $request->chat_id,

            ], 400);
        }
        // dd($check_chat_exist);
    }
}
