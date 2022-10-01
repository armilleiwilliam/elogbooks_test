<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyJobsController;

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
    return view('welcome');
});


Route::prefix('property-jobs')->group(function(){
    Route::get('/', [PropertyJobsController::class, 'index'])->name("job_list_formatted");
    Route::get('/jobs-list', [PropertyJobsController::class, 'jobsList'])->name("list_jobs");
    Route::get('/add-job', [PropertyJobsController::class, 'create'])->name("add_job");
    Route::get('/edit/{id}', [PropertyJobsController::class, 'edit'])->name("edit_job");
    Route::get('/update/{id}', [PropertyJobsController::class, 'update'])->name("update_job");
    Route::post('/store-job', [PropertyJobsController::class, 'store'])->name("store_job");
    Route::get('/property-list', [PropertyJobsController::class, 'propertyList'])->name("properties");
});

