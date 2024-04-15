<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [AuthController::class, 'Login'])->name('login');

Route::get('send', [DashboardController::class, 'Send'])->name('send');


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');
    Route::get('/reminder', [DashboardController::class, 'Reminder'])->name('reminder');
    Route::get('/student', [DashboardController::class, 'Student'])->name('student');
    Route::get('/course', [DashboardController::class, 'Course'])->name('course');
    Route::get('/subject', [DashboardController::class, 'Subject'])->name('subject');
    Route::get('/room', [DashboardController::class, 'Room'])->name('room');
    Route::get('/instructor', [DashboardController::class, 'Instructor'])->name('instructor');
    Route::get('/time', [DashboardController::class, 'Time'])->name('time');
    Route::get('/list', [DashboardController::class, 'List'])->name('list');
});
