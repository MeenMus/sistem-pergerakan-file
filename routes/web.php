<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\CreateFileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserRequestFileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\UserController;
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




Route::group(['middleware' => ['auth','admin']], function() {

    Route::get('create-file',[CreateFileController::class, 'create']);
    Route::post('create-file',[CreateFileController::class, 'store']);

    Route::get('edit-file/{id}',[CreateFileController::class, 'getfile']);
    Route::post('edit-file/{id}',[CreateFileController::class, 'editfile']);

    Route::post('importfile',[CreateFileController::class, 'import']);

    Route::get("file-page/{id}",[FileController::class, 'viewfilepage']);

    Route::get('dashboard',[DashboardController::class, 'dashboard']);

    Route::get('manage-request/{code}',[ApplicationController::class, 'request']);
    Route::get('/manage-checkout/{code}/{applicant_id}',[ApplicationController::class, 'getrequestfiles']);
    Route::post('/manage-checkout/{code}/{applicant_id}',[ApplicationController::class, 'checkout']);

    Route::get('manage-unreturned/{code}',[ApplicationController::class, 'unreturned']);
    Route::get('manage-checkin/{code}/{applicant_id}',[ApplicationController::class, 'getunreturnedfiles']);
    Route::post('manage-checkin/{code}/{applicant_id}',[ApplicationController::class, 'checkin']);

    Route::get('view-archive/{code}',[ArchiveController::class, 'create2']);
    Route::post('view-archive/{code}',[ArchiveController::class, 'unarchiveFiles']);
    Route::post('editarchive/{code}',[ArchiveController::class, 'editarchive']);
    Route::post('editcenter/{code}',[ArchiveController::class, 'editcenter']);


    Route::get('move-file/{code}',[MovementController::class, 'create']);
    Route::post('move-file/{code}',[MovementController::class, 'moveFiles']);
 
    Route::get('view-file/{code}',[ArchiveController::class, 'create']);
    Route::post('view-file/{code}',[ArchiveController::class, 'archiveFiles']);
    Route::get('view-archive-file/{code}',[FileController::class, 'viewarchivefile']);
    Route::get('view-unarchive-file/{code}',[FileController::class, 'viewunarchivefile']);

    Route::post('search',[FileController::class, 'search']);

    Route::get('applications-log/{id}',[ApplicationController::class, 'movementlog']);

    Route::get('manual',[DashboardController::class, 'manual']);

});


Route::group(['middleware' => ['auth','superadmin']], function() {

    Route::get('centercontrol',[CenterController::class, 'create']);
    Route::post('createcenter',[CenterController::class, 'store']);
    Route::post('deletecenter',[CenterController::class, 'deletecenter']);
    Route::post('editcenter',[CenterController::class, 'editcenter']);


    Route::get('usercontrol',[UserController::class, 'viewuser']);
    Route::post('rolecontrol',[UserController::class, 'rolecontrol']);
    Route::post('deleteuser',[UserController::class, 'deleteuser']);
    Route::post('createuser',[UserController::class, 'createuser']);
    Route::get('edit-user/{id}',[UserController::class, 'getuser']);
    Route::post('editid/{id}',[UserController::class, 'editid']);
    Route::post('editname/{id}',[UserController::class, 'editname']);
    Route::post('editemail/{id}',[UserController::class, 'editemail']);
    Route::post('editpassword/{id}',[UserController::class, 'editpassword']);

    Route::get('delete-file/{code}',[FileController::class, 'getfile']);
    Route::post('delete-file/{code}',[FileController::class, 'deletefile']);


});

Route::get('home/{id}',[UserRequestFileController::class, 'userfile'])->middleware('auth');
Route::post('cancelapp',[ApplicationController::class, 'cancelapp'])->middleware('auth');


Route::get('request-file/{id}',[UserRequestFileController::class, 'viewfile'])->middleware('auth');
Route::post('request-file',[UserRequestFileController::class, 'store'])->middleware('auth');
Route::post('logout',[SessionsController::class, 'destroy'])->middleware('auth');


Route::get('/',[SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('/',[SessionsController::class, 'store'])->name('login')->middleware('guest');

Route::get('/register',[SessionsController::class, 'create_reg'])->name('register')->middleware('guest');
Route::post('/register',[SessionsController::class, 'store_reg'])->name('register')->middleware('guest');