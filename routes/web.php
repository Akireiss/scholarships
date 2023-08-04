<?php
use App\Http\Controllers\AuthController;
use App\Http\Livewire\ViewForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// account
use App\Http\Controllers\accountSetController;
use App\Http\Controllers\addScholarController;
// add
use App\Http\Livewire\Grantees;
use App\Http\Controllers\AddStudentController;
// audit
use App\Http\Controllers\auditController;
use App\Http\Livewire\AuditTrail;
// view
use App\Http\Controllers\AdminGovernmentController;
use App\Http\Controllers\StudentController;

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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// register here

    Route::controller(AuthController::class)->group(function() {
    // admin
    Route::get('admin/settings/register', 'register')->name('admin.settings.register');
    Route::post('register', 'registerSave')->name('register.save');
    // staff
    Route::get('staff/settings/register', 'registerStaff')->name('staff.settings.register');
    Route::post('register', 'registerSave')->name('register.save');



        // log in

        Route::get('login', 'login')->name('login');
        Route::post('login', 'loginAction')->name('login.action');


// for the users dashboard
Route::middleware('auth')->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/staff/dashboardStaff', 'staff.dashboardStaff')->name('staff.dashboardStaff');
    Route::view('/campus-NLUC/dashboard', 'campus-NLUC.dashboardCamp')->name('campus-NLUC.dashboardCamp');
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
Route::get('staff/scholarship/view', [AdminGovernmentController::class, 'viewStaff'])->name('staff.scholarship.view');
// campus-NLUC
});

// tables to view
// admin
Route::get('/student_table', StudentTable::class)->name('student_table');
Route::get('admin/scholarship/student_table', [StudentController::class, 'student_table'])->name('admin.scholarship.student_table');



// add grantees
// admin
Route::get('/admin/scholarship/grantees', Grantees::class)->name('admin.scholarship.grantees');
Route::get('admin/scholarship/grantees', [AddStudentController::class, 'grantees'])->name('admin.scholarship.grantees');
// staff
Route::get('/staff/scholarship/grantees', Grantees::class)->name('staff.scholarship.grantees');
Route::get('staff/scholarship/grantees', [AddStudentController::class, 'granteesStaff'])->name('staff.scholarship.grantees');
// campus-NLUC



// settings
Route::get('admin/settings/accountSettings',[accountSetController::class, 'accountSettings'])->name('admin.settings.accountSettings');
// auditlogs
// admin
Route::get('/admin/settings/auditTrail', AuditTrail::class)->name('admin.settings.auditTrail');
Route::get('/admin/settings/auditTrail', [auditController::class, 'audit'])->name('admin.settings.auditTrail');
// staff
Route::get('/staff/settings/auditTrail', AuditTrail::class)->name('staff.settings.auditTrail');
Route::get('/staff/settings/auditTrail', [auditController::class, 'auditStaff'])->name('staff.settings.auditTrail');




// add scholarship
// admin
Route::get('/admin/settings/addScholar', [addScholarController::class, 'showForm'])->name('admin.settings.addScholar');
Route::post('/admin/settings/addScholar', [addScholarController::class, 'submitForm'])->name('scholarship.submit');
// staff
Route::get('/staff/settings/addScholar', [addScholarController::class, 'showFormStaff'])->name('staff.settings.addScholar');
Route::post('/staff/settings/addScholar', [addScholarController::class, 'submitFormStaff'])->name('scholarship.submit.staff');


});














// staff here
