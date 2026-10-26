<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartStudentCalendarController;

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

Route::get('/smart-student-calendar', [
    SmartStudentCalendarController::class,
    'index'
])->name('smart-student-calendar.index');

Route::post('/smart-student-calendar/organize', [
    SmartStudentCalendarController::class,
    'organize'
])->name('smart-student-calendar.organize');

