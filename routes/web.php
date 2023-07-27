<?php
// use App\Http\Controllers\AddStudentController;
// use App\Http\Controllers\AdminGovernmentController;
// use App\Http\Controllers\AdminPrivateController;
use App\Http\Controllers\AdminGovernmentController;
use App\Http\Controllers\AuthController;
use App\Http\Livewire\ViewForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AddStudentPrivateController;
use App\Http\Controllers\accountSetController;
use App\Http\Controllers\AddStudentController;
use App\Http\Livewire\Grantees;
use App\Http\Controllers\StaffaddStudentController;
use App\Http\Controllers\StaffGovernmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// admin here
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// register here

Route::controller(AuthController::class)->group(function() {
    Route::get('admin/settings/register', 'register')->name('admin.settings.register');
    // to save the data of the user's
        Route::post('register', 'registerSave')->name('register.save');
    // it ends here

        // log in

        Route::get('login', 'login')->name('login');
        Route::post('login', 'loginAction')->name('login.action');


// for the admin dashboard
Route::middleware('auth')->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/staff/dashboardStaff', 'staff.dashboardStaff')->name('staff.dashboardStaff');
});


// log out

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Scholarship tables to view

Route::middleware('auth')->group(function () {
// admin
Route::get('/view-form', ViewForm::class)->name('view-form');
Route::get('admin/scholarship/view', [AdminGovernmentController::class, 'view'])->name('admin.scholarship.view');
// staff
Route::get('/view-form', ViewForm::class)->name('view-form');
Route::get('staff/scholarship/view', [StaffGovernmentController::class, 'view'])->name('staff.scholarship.view');
});


// add grantees
// admin
Route::get('/admin/scholarship/grantees', Grantees::class)->name('admin.scholarship.grantees');
Route::get('admin/scholarship/grantees', [AddStudentController::class, 'grantees'])->name('admin.scholarship.grantees');
// staff
Route::get('/staff/scholarship/grantees', Grantees::class)->name('staff.scholarship.grantees');
Route::get('staff/scholarship/grantees', [StaffaddStudentController::class, 'grantees'])->name('staff.scholarship.grantees');



// settings
Route::get('admin/settings/accountSettings',[accountSetController::class, 'accountSettings'])->name('admin.settings.accountSettings');

// add scholarship


});














// staff here
