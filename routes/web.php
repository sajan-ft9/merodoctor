<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PatientController;

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

Route::controller(PublicController::class)->group(function(){
    Route::get('/','index');

});

Route::middleware(['guest'])->controller(AuthController::class)->group(function(){
    Route::get('/login_form',  'loginForm')->name('loginForm');
    Route::post('/login',  'login')->name('login');
    
    Route::get('/doctor/register',  'showDoctorRegister')->name('doctor.registerForm');
    Route::post('/doctor/store',  'doctorRegister')->name('doctor.register');
    
    Route::get('/patient/register',  'showPatientRegister')->name('patient.registerForm');
    Route::post('/patient/store',  'patientRegister')->name('patient.register');
    
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth', 'patient'])->prefix('patient')->name('patient.')->controller(PatientController::class)->group(function(){
    Route::get('/', 'index')->name('dashboard');
    Route::get('/appointment', 'appointment')->name('appointment');
    Route::get('/show_appointment', 'showAppointment')->name('show_appointment');
    Route::post('/make_appointment', 'makeAppointment')->name('make_appointment');
    Route::get('/all_doctors', 'allDoctors')->name('all_doctors');
    Route::get('/doctor_details/{doctor}', 'doctorDetails')->name('doctor_details');
    Route::get('/profile', 'profile')->name('profile');
    Route::patch('/update/{patient}', 'update')->name('update');
    Route::patch('/update_password', 'updatePassword')->name('update_password');
    Route::get('edit_appointment/{appoint}','editAppointment')->name('edit_appointment');
    Route::patch('update_appointment/{appoint}','updateAppointment')->name('update_appointment');
    Route::delete('delete_appointment/{appoint}','deleteAppointment')->name('delete_appointment');
});

Route::middleware(['auth', 'doctor'])->prefix('doctor')->name('doctor.')->controller(DoctorController::class)->group(function(){
    Route::get('/', 'index')->name('dashboard');
    Route::get('/all_doctors', 'allDoctors')->name('all_doctors');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/show_appointment', 'showAppointment')->name('show_appointment');
    Route::get('/completed_appointment', 'completedAppointment')->name('completed_appointment');
    Route::patch('/update/{doctor}', 'update')->name('update');
    Route::patch('/update_password', 'updatePassword')->name('update_password');
    Route::patch('/toggle_approval/{appointment}', 'toggleApproval')->name('toggle_approval');
    Route::patch('/toggle_status/{appointment}', 'toggleStatus')->name('toggle_status');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->controller(AdminController::class)->group(function(){
    Route::get('/', 'index')->name('dashboard');
    Route::get('/all_doctors', 'allDoctors')->name('all_doctors');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/approval_requests', 'approvalRequests')->name('approval_requests');
    Route::patch('/update/{admin}', 'update')->name('update');
    Route::patch('/update_password', 'updatePassword')->name('update_password');
    Route::patch('/toggle_approval/{doctor}', 'toggleApproval')->name('toggle_approval');
});

