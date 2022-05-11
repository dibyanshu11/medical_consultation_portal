<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Chat;
use App\Models\Doctor;
use App\Models\User;

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
        $chats=Chat::with('doctor','user')->find($id);
        return view('admin.patient_history.chat_view', compact('chats'));
    }

}
