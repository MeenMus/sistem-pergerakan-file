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

    /* tset */
    Route::get('create-file',[CreateFileController::class, 'create']);
    Route::post('create-file',[CreateFileController::class, 'store']);

    Route::get('edit-file/{id}',[CreateFileController::class, 'getfile']);
    Route::post('edit-file/{id}',[CreateFileController::class, 'editfile']);

    Route::get('create-center',[CenterController::class, 'create']);
    Route::post('create-center',[CenterController::class, 'store']);

    Route::get("file-page/{id}",[FileController::class, 'viewfilepage']);

    Route::get('dashboard',[DashboardController::class, 'dashboard']);

    Route::get('manage-request/{code}',[ApplicationController::class, 'request']);
    Route::get('/manage-checkout/{code}/{applicant_id}',[ApplicationController::class, 'getrequestfiles']);
    Route::post('/manage-checkout/{code}/{applicant_id}',[ApplicationController::class, 'checkout']);

    Route::get('manage-unreturned/{code}',[ApplicationController::class, 'unreturned']);
    Route::get('manage-checkin/{code}/{applicant_id}',[ApplicationController::class, 'getunreturnedfiles']);
    Route::post('manage-checkin/{code}/{applicant_id}',[ApplicationController::class, 'checkin']);

    Route::get('archive-file/{code}',[ArchiveController::class, 'create']);
    Route::post('archive-file/{code}',[ArchiveController::class, 'archiveFiles']);
    Route::get('unarchive-file/{code}',[ArchiveController::class, 'create2']);
    Route::post('unarchive-file/{code}',[ArchiveController::class, 'unarchiveFiles']);
    Route::post('view-archive-file/{code}',[ArchiveController::class, 'editarchive']);

    Route::get('move-file/{code}',[MovementController::class, 'create']);
    Route::post('move-file/{code}',[MovementController::class, 'moveFiles']);
 
    Route::get('view-file/{code}',[FileController::class, 'viewfile']);
    Route::get('view-archive/{code}',[FileController::class, 'viewarchive']);
    Route::get('view-archive-file/{code}',[FileController::class, 'viewarchivefile']);
    Route::get('view-unarchive-file/{code}',[FileController::class, 'viewunarchivefile']);

    Route::post('search',[FileController::class, 'search']);

    Route::get('applications-log/{id}',[ApplicationController::class, 'movementlog']);

    Route::get('manual',[DashboardController::class, 'manual']);

});

Route::get('home/{id}',[UserRequestFileController::class, 'userfile'])->middleware('auth');


Route::get('request-file/{id}',[UserRequestFileController::class, 'viewfile'])->middleware('auth');
Route::post('request-file',[UserRequestFileController::class, 'store'])->middleware('auth');
Route::post('logout',[SessionsController::class, 'destroy'])->middleware('auth');


Route::get('/',[SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('/',[SessionsController::class, 'store'])->name('login')->middleware('guest');
