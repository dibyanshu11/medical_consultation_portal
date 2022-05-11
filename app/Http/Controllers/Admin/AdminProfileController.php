<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;


class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Profile()
    {

        $admin = User::find(auth()->user()->id);

        return view('admin.admin-profile')->with('admin', $admin);
    }
    public function  changePassword()
    {
        return view('admin.change-password');
    }

    public function  UpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password'
        ]);

        $hashedPassword = Auth::user()->password;
        if (\Hash::check($request->current_password, $hashedPassword)) {

            $password = Hash::make($request->new_password);
            User::updateOrCreate(['id' => Auth::user()->id], [

                'password' =>  $password
            ]);
            return redirect()->route('admin-profile')->with('success', 'password updated successfully');
           
        } else {
            return redirect()->route('admin-profile')->with('error', 'current password doesnt matched');

        }
       
    }
    public function UpdateProfile(Request $request)
    {
        if ($request->email) {
            User::where('id', auth()->user()->id)
                ->update(
                    ['email' => $request->email]
                );
       
        }
        return redirect()->back()->with('success', 'email updated successfully');
 
    }

    public function uploadPhoto(Request $request)
    {

        if ($request->image) {

            $data = $request->image;

            list($type, $data) = explode(';', $data);

            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);

            $image_name = time() . '.png';

            $path = public_path() . "/storage/user-profile/" . $image_name;

            file_put_contents($path, $data);

            User::where(['id' => auth()->user()->id])

                ->update([

                    'image' => $image_name

                ]);
        }

        return response()->json(['success' => 'success']);
    }
}
