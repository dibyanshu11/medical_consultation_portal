<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function supportIndex()
    {
        return view('admin.support.index');
    }

}
