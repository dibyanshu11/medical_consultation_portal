<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Mail;
use App\Mail\RegisterOtp;
use App\Mail\PasswordResetOtp;

class UserController extends Controller
{

    // Register api 

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {

            $input = $request->all();
            $input['device_type'] = $request->device_type;
            $input['device_token'] = $request->device_type;
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "ReturnCode" => 1,
                "token" => $token,
                'token_type' => 'Bearer',
                "ReturnMessage" => "Registered successfully.",
                "data" => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "error" => $e
            ], 400);
        }
    }
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'email or password Invaild'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;


        User::where('id', $user['id'])
            ->update(["device_type" => $request->device_type, 'device_token' => $request->device_token]);

        return response()
            ->json(['token' => $token, 'token_type' => 'Bearer', 'data' =>  $user]);
    }


    /**
     * Password reset Request
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

    public function changePassword(Request $request)
    {
        if ($request->user_id) {
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if ($request->filled('password')) {

                $isExist =  DB::table('users')->where('id', $request->user_id)
                    ->update(['password' => bcrypt($request->password)]);

                if ($isExist) {
                    return response()->json([
                        "ReturnCode" => 1,
                        "ReturnMessage" => "Password changed successfully.",

                    ], 200);
                } else {
                    return response()->json([
                        "ReturnCode" => 0,
                        "ReturnMessage" => "Invalid User Id.",
                    ], 400);
                }
            }
        } else {
            $validator = Validator::make($request->all(), [
                'otp' => 'required',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if ($request->filled('password')) {

                $isExist =  DB::table('users')->where('remember_token', $request->otp)
                    ->update(["remember_token" => null, 'password' => bcrypt($request->password)]);

                if ($isExist) {
                    return response()->json([
                        "ReturnCode" => 1,
                        "ReturnMessage" => "Password changed successfully.",

                    ], 200);
                } else {
                    return response()->json([
                        "ReturnCode" => 0,
                        "ReturnMessage" => "Invalid OTP.",
                    ], 400);
                }
            }
        }
    }

    /**
     * Returns Send OTP for password reset
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request)
    {

        if ($request->filled('email')) {

            $user = User::where('email', $request->email)->first();
            if ($user) {
                $otp = rand(100000, 999999);
                $data = [
                    "user_id" => $user->id,
                    "otp" => $otp
                ];

                // Need to check
                Mail::to($request->email)->send(new PasswordResetOtp($otp, $user));


                DB::table('users')->where('id', $user->id)
                    ->update(["remember_token" => $otp]);

                return response()->json([
                    "ReturnCode" => 1,
                    "ReturnMessage" => "OTP sent to your email.",
                    "data" => $data
                ], 200);
            } else {
                return response()->json([
                    "ReturnCode" => 0,
                    "ReturnMessage" => "User not found!",
                ], 400);
            }
        }

        return response()->json([
            "ReturnCode" => 0,
            "ReturnMessage" => "Please enter email or phone",
            "data" => []
        ], 200);
    }


    public function profileDetails()
    {

        $user = User::where('id', Auth::user()->id)->first();;

        return response()->json([
            "ReturnCode" => 1,
            "ReturnMessage" => "User Details.",
            "data" => $user
        ], 200);
    }



    // profile Update

    public function profileUpdate(Request $request)
    {
        $input = $request->all();
        $id = Auth::user()->id;

        if ($request->filled("mobile")) {
            if (Auth::user()->mobile != $request->mobile) {
                $user = DB::table('users')->where('mobile', $request->mobile)->count();
                if ($user) {
                    return response()->json([
                        "ReturnCode" => 0,
                        "ReturnMessage" => "This phone number already exists.",
                    ], 400);
                }
            }
        }

        if ($request->filled("email")) {
            if (Auth::user()->email != $request->email) {
                $user = DB::table('users')->where('email', $request->email)->count();
                if ($user) {
                    return response()->json([
                        "ReturnCode" => 0,
                        "ReturnMessage" => "This email id already exists.",

                    ], 400);
                }
            }
        }

        $image = "";

        if ($request->has('image')) {
            $file = $request->file('image');
            $path = public_path('/storage/user-profile/');
            if (@$file) {
                $fileType = $file->getMimeType();
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $fileExtension;
                $file->move($path, $fileName);
                $image = $fileName;
            }
        }


        $input = [
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'image' => $image
        ];

        try {
            $isUpdate =  User::where('id', $id)
                ->update($input);

            if ($isUpdate) {
                $data = User::where('id', $id)->first();
                return response()->json([
                    "ReturnCode" => 1,
                    "ReturnMessage" => "Profile updated successfully.",
                    "data" => $data
                ], 200);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                "ReturnCode" => 0,
                "ReturnMessage" => "Please try again and check payload.",
                "error" => $e
            ], 400);
        }
    }

    public function changeUserPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {

            DB::table('users')->where('id', Auth::user()->id)
                ->update([
                    'password' => $request->password,
                ]);

            return response()->json([
                "ReturnCode" => 1,
                "ReturnMessage" => "Password updated successfully.",

            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                "ReturnCode" => 0,
                "error" => $e,
            ], 400);
        }
    }
    
      public function doctorUserChat(Request $request)
    {
        $isDoctorExist = Doctor::where('id', '=', $request->doctor_id)->count();
        if ($isDoctorExist == 0) {
            return response()->json([
                "ReturnCode" => 0,
                "ReturnMessage" => "Doctor Not found with Id " . $request->doctor_id,

            ], 400);
        }

        $input = $request->all();

        $input['user_id'] = Auth::user()->id;
        $input['doctor_id'] = $request->doctor_id;
        $input['chat'] =
            $chat = Chat::create($input);

        return response()->json([
            "ReturnCode" => 1,
            "ReturnMessage" => "Chat saved successfully.",
            "data" => $chat
        ], 200);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
