<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoodMoralController;
use App\Http\Controllers\CounselController;
use App\Http\Controllers\GuidanceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\StudentRecordController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\CalendarController;

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
Route::get('fullcalender', [CalendarController::class, 'index']);
Route::post('fullcalenderAjax', [CalendarController::class, 'ajax']);

// Route::post('fullcalenderAjax', [CounselController::class, 'ajax']);

Route::get('/violation', [ViolationController::class, 'showForm']);
Route::post('/classify', [ViolationController::class, 'classifyViolation']);
Route::post('/getOffenseLevel', [StudentRecordController::class,'getOffenseLevel'])->name('getOffenseLevel');


    Route::get('/', [AnnouncementController::class, 'index1'])->name('welcome');

    Route::get('/graduation', function () {
        return view('announcements/graduation');
    });

    Route::get('/immersion', function () {
        return view('announcements/immersion');
    });

    Route::get('/handbook', function () {
        return view('announcements/studenthandbook');
    });

    Route::get('/orgchart', function () {
        return view('announcements/orgchart');
    });

    Route::get('/tup-mission-vision', function () {
        return view('announcements/tup-mission-vision');
    });

    Route::get('/announcements/announcement', [AnnouncementController::class, 'announcement'])->name('announcement-page');
    Route::post('/announcements/create', [App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcement',[AnnouncementController::class, 'store'])->name('announcement.store');
    Route::get('/comment/{id}', [App\Http\Controllers\CommentController::class, 'infos'])->name('announcements.show');
    Route::post('/comment/create', [App\Http\Controllers\CommentController::class, 'create'])->name('comment.create');
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Auth::routes();

    Route::get('dashboard', [LoginController::class, 'dashboard']); 
    Route::get('signout', [LoginController::class, 'signOut'])->name('signout');
    Route::post('signup', [LoginController::class, 'postSignup'])->name('signup'); 

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    //-----------------------DASHBOARD CONTROLLER-------------------------------------------//
    Route::get('/student/index', [StudentController::class, 'index'])->name('studentindex');
    Route::get('/studentrecord/index', [StudentRecordController::class, 'index'])->name('studentrecordindex');
    Route::get('indexrecord', [NotificationController::class, 'index'])->name('indexrecord'); 
    Route::get('topviolator', [DashboardController::class, 'index2'])->name('topviolator'); 
    Route::get('filter/topviolator', [DashboardController::class, 'filter2'])->name('dashboard.filter2'); 
    Route::get('filter', [DashboardController::class, 'filter1'])->name('dashboard.filter'); 
    Route::get('filter/violationrecord', [DashboardController::class, 'filter3'])->name('dashboard.filter3'); 


    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.updates');

});

//-----------------------GUIDANCE PROTECTED ROUTES-------------------------------------------//
Route::group(['middleware' => 'role:guidance'], function() {

    Route::resource('announcement', AnnouncementController::class);
    Route::get('/announcements/index', [AnnouncementController::class, 'index'])->name('announcementindex');
    Route::get('/announcements/edit/{id}',[AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::get('/student/index', [StudentController::class, 'index'])->name('studentindex');
    Route::post('/student/import', [StudentController::class,'import'])->name('studentImport');
    Route::get('/studentrecord/index', [StudentRecordController::class, 'index'])->name('studentrecordindex');
    Route::get('/studentrecord/update/{id}',[StudentRecordController::class,'update'])->name('students.update');
    Route::get('/studsearch', [StudentRecordController::class,'search'])->name('studsearch');
    Route::resource('student',StudentController::class)->except('index');
    Route::resource('studentrecord',StudentRecordController::class)->except(['index','update']);
    Route::get('indexrecord', [NotificationController::class, 'index'])->name('indexrecord'); 
    Route::get('profilerecord/{id}', [NotificationController::class, 'getRecord'])->name('profilerecord'); 
    Route::get('sendnotif/{id}', [NotificationController::class, 'sendnotification'])->name('sendnotif'); 
    Route::get('topviolator', [DashboardController::class, 'index2'])->name('topviolator'); 
    Route::get('filter/topviolator', [DashboardController::class, 'filter2'])->name('dashboard.filter2'); 
    Route::get('/guidance/index',[GuidanceController::class,'profile'])->name('guidance.profile');
    Route::post('/guidance/import', [GuidanceController::class,'import'])->name('guidanceImport');
    Route::get('guidanceedit/{id}', [GuidanceController::class, 'editProfile'])->name('guidance.editprofile'); 
    Route::get('guidance/passwordedit/{id}', [GuidanceController::class, 'editPassword'])->name('guidance.editpassword'); 
    Route::put('guidance/profile/{id}', [GuidanceController::class, 'updateprofile'])->name('guidanceprofile.update');
    Route::get('create/counsel', [CounselController::class, 'create'])->name('counsel.create'); 
    Route::post('/counsel',[CounselController::class, 'store'])->name('counsel.store');
    Route::get('/counsel/index',[CounselController::class, 'index'])->name('counsel.index');
    Route::get('/counsel/edit/{id}',[CounselController::class, 'edit'])->name('counsel.edit');
    Route::put('/counsel/update/{id}',[CounselController::class, 'update'])->name('counsel.update');
    Route::resource('guidance', GuidanceController::class)->except('show');
    Route::post('/guidance/import', [GuidanceController::class,'import'])->name('guidanceImport');
    // Route::get('/update/{id}', [App\Http\Controllers\StudentRecordController::class, 'update'])->name('statusUpdate');
});

//-----------------------STUDENT PROTECTED ROUTES-------------------------------------------//
Route::group(['middleware' => 'role:student'],function(){
    Route::get('studentchart', [DashboardController::class, 'studentchart'])->name('studentchart'); 
    Route::get('studentdashboard', [DashboardController::class, 'index1'])->name('studentdashboard'); 
    Route::get('studentprofile', [StudentController::class, 'profile'])->name('studentprofile'); 
    Route::get('studentedit/{id}', [StudentController::class, 'editProfile'])->name('editprofile'); 
    Route::get('passwordedit/{id}', [StudentController::class, 'editPassword'])->name('editpassword'); 
    Route::get('filter', [DashboardController::class, 'filter1'])->name('dashboard.filter'); 
    Route::put('/student/profile/{id}', [StudentController::class, 'updateprofile'])->name('profile.update');
    Route::put('/student/password/{id}', [StudentController::class, 'updatePassword'])->name('password.updates');
    Route::get('studentdashboard', [DashboardController::class, 'index1'])->name('studentdashboard');
    Route::get('filter', [DashboardController::class, 'filter1'])->name('dashboard.filter');
    Route::get('studentviolation/create', [StudentRecordController::class, 'create1'])->name('studentviolation.create'); 
    Route::post('studentviolationreport',[StudentRecordController::class, 'store'])->name('studentviolationreport.store');
});

//-----------------------GOOD MORAL ROUTES-------------------------------------------//
Route::get('goodmoralstore', [GoodMoralController::class, 'store'])->name('goodmoralstore');
Route::get('/goodmoral', [GoodMoralController::class, 'index'])->name('goodmoralindex');
Route::delete('/goodmoral/delete/{id}', [GoodMoralController::class, 'delete'])->name('goodmoraldelete');
Route::put('/goodmoral/update/{id}', [GoodMoralController::class, 'update'])->name('goodmoralupdate');
Route::post('/goodmoral/{id}/schedule', [GoodMoralController::class, 'scheduleDate'])->name('goodmoralschedule');

