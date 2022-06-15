<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AddOfficeController;
use App\Http\Controllers\Admin\AdminDoctorController;
use App\Http\Controllers\Admin\CreateConsultationController;
use App\Http\Controllers\Admin\PatientHistoryController;
use App\Http\Controllers\Admin\SupportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});




Route::middleware(['auth', 'verified'])->group(function () {



    Route::controller(AdminProfileController::class)->group(function () {

        //user profile
        Route::get('home', 'Profile')->name('admin-profile');
        Route::get('/user-profile', 'userProfile')->name('user-profile');
        Route::post('/update-profile', 'UpdateProfile')->name('update-profile');
        Route::post('/update-profile-pic', 'uploadPhoto');

        //change password
        Route::get('change-password', 'changePassword')->name('change-password');
        Route::post('update-password', 'updatePassword')->name('update-password');
    });


    Route::controller(AddOfficeController::class)->group(function () {

        //Office profile
        Route::get('index', 'officeIndex')->name('office-index');
        Route::get('create-office', 'createOffice')->name('create-office');
        Route::post('store-office', 'storeOffice')->name('store-office');
        Route::get('offfice/{id}', 'officeEdit')->name('office-edit');
        Route::patch('office-update/{id}', 'officeUpdate')->name('office-update');
        Route::delete('office/delete/{id}', 'deleteOffice')->name('office-delete');
    });

    Route::controller(AdminDoctorController::class)->group(function () {

        //Doctor profile
        Route::get('doctor-index', 'doctorIndex')->name('doctor-index');
        Route::get('add-doctor', 'addDoctor')->name('add-doctor');
        Route::post('store-doctor', 'storeDoctor')->name('store-dotor');
        Route::get('doctor/{id}', 'doctorEdit')->name('doctor-edit');
        Route::patch('doctor-update/{id}', 'doctorUpdate')->name('doctor-update');
        Route::post('doctor/deactive/{id}', 'deactiveDotor')->name('doctor-deactive');
        Route::post('doctor/active/{id}', 'activeDotor')->name('doctor-active');
        Route::post('/update-doctor-pic', 'uploadDoctorPhoto');
    });


    //Consultation
    Route::controller(CreateConsultationController::class)->group(function () {

        Route::get('consultation-index', 'consultationIndex')->name('consultation-index');
        Route::get('add-consultation', 'addconsultation')->name('add-consultation');
        Route::post('doctor_list', 'doctorList')->name('doctor_list');
        Route::post('store-consultation', 'storeConsultation')->name('store-consultation');
        Route::get('consultation/{id}', 'consultaionEdit')->name('consultation-edit');
        Route::patch('consultation-update/{id}', 'doctorUpdate')->name('consultation-update');
        Route::delete('consultation/delete/{id}', 'deleteConsultation')->name('consultation-delete');
    });

  //patient-history
    Route::controller(PatientHistoryController::class)->group(function () {
        Route::get('patient-index', 'patientIndex')->name('patient-index');
        Route::get('chat-view/{id}', 'chatView')->name('chat-view');
    });

    Route::controller(SupportController::class)->group(function () {

        //create-consultation
        Route::get('support-index', 'supportIndex')->name('support-index');
    });
});
