<?php

use Livewire\Livewire;
use App\Http\Livewire\Grantees;
use App\Http\Livewire\AccountSet;
use App\Http\Livewire\AuditTrail;
use App\Http\Livewire\NlucGrantees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// account
use App\Http\Controllers\UserController;
// add
use App\Http\Livewire\Admin\EditStudent;
// view
use App\Http\Controllers\auditController;
use App\Http\Controllers\backupController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\programController;
use App\Http\Controllers\ScholarController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\accountSetController;
use App\Http\Controllers\addScholarController;
use App\Http\Controllers\AddStudentController;
use App\Http\Controllers\schoolyearController;
use App\Http\Controllers\AdminGovernmentController;
use App\Http\Controllers\AdminController;



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
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('staff/dashboardStaff', [DashboardController::class, 'index1'])->name('staff.dashboardStaff');
    Route::get('campus-NLUC/dashboardCamp', [DashboardController::class, 'index2'])->name('campus-NLUC.dashboardCamp');


});


// log out

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// students
// admin
Route::get('admin/student', [StudentsController::class, 'studentAdmin'])->name('admin.student');
// addStudent
Route::get('/admin/actions/add_student', [AdminController::class, 'adminAdd'])->name('admin.actions.add_student');

// staff
// nluc


// Scholarship tables to view
Route::middleware('auth')->group(function () {
    // admin
    Route::get('admin/scholarship/view', [AdminGovernmentController::class, 'view'])->name('admin.scholarship.view');

    // staff
    Route::get('staff/scholarship/view', [AdminGovernmentController::class, 'viewStaff'])->name('staff.scholarship.view');

    // campus-NLUC
    Route::get('campus-NLUC/scholarship/view', [AdminGovernmentController::class, 'viewNLUC'])->name('campus-NLUC.scholarship.view');

});
// Route::get('layouts/includes/admin/navbar', [NavbarController::class, 'notification'])
//     ->name('layouts.includes.admin.navbar');



// view more
// admin
Route::get('admin/scholarship/actions/view_more/{student}', [StudentController::class, 'viewMore'])->name('admin.scholarship.actions.view_more');
// staff
Route::get('staff/scholarship/actions/view_more/{student}', [StudentController::class, 'viewMoreStaff'])->name('staff.scholarship.actions.view_more');
// NLUC
Route::get('campus-NLUC/scholarship/actions/view_more/{student}', [StudentController::class, 'viewMoreNLUC'])->name('campus-NLUC.scholarship.actions.view_more');
// update
// admin
Route::get('admin/scholarship/actions/edit/{student}', [StudentController::class, 'editAdmin'])->name('admin.scholarship.actions.edit');
// staff
// NLuc
// update
Route::put('campus-NLUC/scholarship/actions/edit/{student}', [StudentController::class, 'editNLUC'])->name('campus-NLUC.scholarship.actions.edit');


// add grantees
// admin
Route::get('/admin/scholarship/grantees{{student}', Grantees::class)->name('admin.scholarship.grantees');
Route::get('admin/scholarship/grantees/{student}', [AddStudentController::class, 'grantees'])->name('admin.scholarship.grantees');
// staff
Route::get('/staff/scholarship/grantees', Grantees::class)->name('staff.scholarship.grantees');
Route::get('staff/scholarship/grantees', [AddStudentController::class, 'granteesStaff'])->name('staff.scholarship.grantees');
// campus-NLUC
Route::get('/campus-NLUC/scholarship/grantees', NlucGrantees::class)->name('campus-NLUC.scholarship.grantees');
Route::get('campus-NLUC/scholarship/grantees', [AddStudentController::class, 'granteesNLUC'])->name('campus-NLUC.scholarship.grantees');



// settings
Route::get('/admin/settings/accountSettings', AccountSet::class)->name('admin.settings.accountSettings');
Route::get('admin/settings/accountSettings',[accountSetController::class, 'accountSettings'])->name('admin.settings.accountSettings');

Route::get('/admin/settings/edit/{id}', [UserController::class, 'edit'])->name('admin.settings.edit');
Route::get('/admin/settings/view/{id}', [UserController::class, 'view'])->name('admin.settings.view');
Route::put('/admin/settings/edit/{id}', [UserController::class, 'update'])->name('admin.settings.update');





// auditlogs
// admin
Route::get('/admin/settings/auditTrail', AuditTrail::class)->name('admin.settings.auditTrail');
Route::get('/admin/settings/auditTrail', [auditController::class, 'audit'])->name('admin.settings.auditTrail');
// staff
Route::get('/staff/settings/auditTrail', AuditTrail::class)->name('staff.settings.auditTrail');
Route::get('/staff/settings/auditTrail', [auditController::class, 'auditStaff'])->name('staff.settings.auditTrail');
// NLUC
Route::get('/campus-NLUC/settings/auditTrail', AuditTrail::class)->name('campus-NLUC.settings.auditTrail');
Route::get('/campus-NLUC/settings/auditTrail', [auditController::class, 'auditNLUC'])->name('campus-NLUC.settings.auditTrail');




// add scholarship
// admin
Route::get('/admin/settings/addScholar', [addScholarController::class, 'showForm'])->name('admin.settings.addScholar');
Route::get('/admin/settings/addScholar/government', [addScholarController::class, 'government'])->name('scholar.government');
Route::get('/admin/settings/addScholar/private', [addScholarController::class, 'government'])->name('scholar.private');
Route::get('/admin/settings/addScholar/government', [addScholarController::class, 'government'])->name('scholar.govermentActive');
Route::get('/admin/settings/addScholar/private', [addScholarController::class, 'government'])->name('scholar.privateActive');




// staff
Route::get('/staff/settings/addScholar', [addScholarController::class, 'showFormStaff'])->name('staff.settings.addScholar');

// nluc
Route::get('/campus-NLUC/settings/addScholar', [addScholarController::class, 'showFormNLUC'])->name('campus-NLUC.settings.addScholar');


// backup
// admin
Route::get('/admin/settings/backup', [backupController::class, 'adminBackup'])->name('admin.settings.backup');
// staff
Route::get('/staff/settings/backup', [backupController::class, 'staffBackup'])->name('staff.settings.backup');
// NLUC
Route::get('/campus-NLUC/settings/backup', [backupController::class, 'nlucBackup'])->name('campus-NLUC.settings.backup');
// reports
// admin
Route::get('/admin/settings/reports', [reportController::class, 'adminReport'])->name('admin.settings.reports');
// staff
// nluc
Route::get('/campus-NLUC/settings/reports', [reportController::class, 'nlucReport'])->name('campus-NLUC.settings.reports');

// Program
// admin
Route::get('/admin/settings/program', [programController::class, 'adminProgram'])->name('admin.settings.program');
// submit
Route::post('/save-campus', [programController::class, 'saveCampus'])->name('saveCampus');
Route::post('/save-course', [programController::class, 'saveCourse'])->name('saveCourse');
// staff
// nluc
Route::get('/campus-NLUC/settings/program', [programController::class, 'nlucProgram'])->name('campus-NLUC.settings.program');
// submit
Route::post('/nluc  save-course', [programController::class, 'nlucsaveCourse'])->name('nlucsaveCourse');

// schoolyear
Route::get('/admin/settings/school-year', [schoolyearController::class, 'yearAdmin'])->name('admin.settings.school-year');
Route::post('/school-year', [schoolyearController::class, 'saveYear'])->name('school-year.save');



//Other function
// admin
Route::get('admin/settings/scholar/edit/{scholar}', [ScholarController::class, 'edit'])->name('scholar.edit');
Route::put('admin/settings/update/{scholar}', [ScholarController::class, 'update'])->name('scholarships.update');
// staff
// nluc
Route::get('campus-NLUC/settings/scholar/edit/{scholar}', [ScholarController::class, 'editNluc'])->name('nlucscholar.edit');
Route::put('campus-NLUC/settings/update/{scholar}', [ScholarController::class, 'updateNluc'])->name('scholarships.nlucupdate');



//Admin Edit Stden
Route::get('admin/scholarship/view/{student}', EditStudent::class)->name('admin.scholarship.edit');

});

