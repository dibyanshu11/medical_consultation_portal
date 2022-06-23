<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\User\DoctorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




// Route::get('/otp-verify', function() {
   
//     return "helloooi sir";
// });

Route::post('/register', [UserController::class, 'register']);
Route::post('/otp-verify', [UserController::class, 'otpVerify']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
Route::post('/change-password', [UserController::class, 'changePassword']);



//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
     
    //user
    Route::get('/user-details', [UserController::class, 'profileDetails']);
    Route::post('/profile-update', [UserController::class, 'profileUpdate']);
    Route::post('/change-user-password', [UserController::class, 'changeUserPassword']);
    
     //Doctor-user-chat

    Route::post('/doctor-user-chat', [UserController::class, 'doctorUserChat']);
    
    
     //summery listing
    Route::post('/summery_list', [UserController::class, 'summeryListing']);
    
    
     //particular chat summery
    Route::post('/view_summery', [UserController::class, 'viewSummery']);


    //  Doctor 
    Route::post('/doctors-list', [DoctorController::class, 'doctorList']);
    Route::post('/doctors-consultation', [DoctorController::class, 'doctorConsultation']);
    Route::post('/end-chat', [DoctorController::class, 'endChat']);



    // API route for logout user
    Route::post('/logout', [UserController::class, 'logout']);
});


