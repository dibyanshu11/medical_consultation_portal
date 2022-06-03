<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Chat;


class PatientHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patientIndex()
    {
        return view('admin.patient_history.index');
    }

    public function chatView($id)
    {

        $conversations = Chat::where('id', $id)->with('chat_data', 'user', 'doctor')->get();

        // dd($conversations);

        return view('admin.patient_history.chat_view', compact('conversations'));
    }
}
