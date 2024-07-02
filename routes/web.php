<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Dashboard;
use App\Livewire\Departments\Index as DepartmentsIndex;
use App\Livewire\Doctor\Index;
use App\Livewire\Patient\Patients;
use App\Livewire\Patient\Create as NewPatient;
use App\Livewire\Rooms\Index as RoomsIndex;
use App\Livewire\Notice\Index as NoticeIndex;
use App\Livewire\Appointments\Index as AppointmentIndex;
use App\Livewire\Bill\Index as BillIndex;
use App\Livewire\Inventory\Index as InventoryIndex;
use App\Livewire\Patient\Admission;
use App\Livewire\Patient\PatientRecord;
use App\Livewire\Staff\NewStaff;
use App\Livewire\Staff\search;
use App\Livewire\Staff\Staff;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth')->group(function(){
    Route::get('/', Login::class)->name('home');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/doctors', Index::class)->name('doctors');
    Route::get('/staff', Staff::class)->name('staff');
    Route::get('/bill', BillIndex::class)->name('bill');
    Route::get('/new-staff', NewStaff::class)->name('new-staff');
    Route::get('/search/{type}',  Search::class)->name('search');
    Route::get('/rooms', RoomsIndex::class)->name('rooms');
    Route::get('/patients', Patients::class)->name('patients');
    Route::get('/new-patient', NewPatient::class)->name('new-patient');
    Route::get('/patient-record/{user_id}', PatientRecord::class)->name('patient-record');
    Route::get('/admit/{id}', Admission::class)->name('admit');
    Route::get('/departments', DepartmentsIndex::class)->name('departments');
    Route::get('/notice', NoticeIndex::class)->name('notice');
    Route::get('/appointments', AppointmentIndex::class)->name('appointments');
    Route::get('/inventory', InventoryIndex::class)->name('inventory');
});




Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
