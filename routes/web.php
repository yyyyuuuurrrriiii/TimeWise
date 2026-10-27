
<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SmartStudentCalendarController;
use Illuminate\Support\Facades\Route;



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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
