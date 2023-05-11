<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherAvailableController;
use App\Http\Controllers\TeacherUsersController;
use App\Http\Controllers\XampleController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\InviteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [UserDashboardController::class, 'index'])
->middleware(['auth', 'verified', 'user-access:user', 'teacher-available'])->name('dashboard');

Route::get('/xample/{xample}', [UserDashboardController::class, 'showXample'])
->middleware(['auth', 'verified', 'user-access:user', 'teacher-available'])->name('showxample');

Route::get('/teacher/dashboard', TeacherDashboardController::class)->middleware(['auth', 'verified','user-access:teacher'])->name('teacher.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*Route::resource('teacheravailable', TeacherAvailableController::class)->only([
    'index', 'update'
])->names([
    'index' => 'teacheravailable.index',
    'update' => 'teacheravailable.update'
])->middleware(['auth', 'user-access:user']);*/

Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('xamples', XampleController::class)
    ->middleware(['auth', 'user-access:teacher']);
    Route::get('users', [TeacherUsersController::class, 'index'])->name('users');
    Route::get('user', [TeacherUsersController::class, 'showUser'])->name('user');
    Route::put('user', [TeacherUsersController::class, 'updateUser'])->name('updateuser');
    Route::get('invite', [InviteController::class, 'index'])->name('invite');
    Route::get('invitepdf', [InviteController::class, 'invitepdf'])->name('invitepdf');
});

Route::middleware('auth', 'user-access:user')->group(function () {
    Route::get('/teacheravailable', [TeacherAvailableController::class, 'index'])->name('teacheravailable.index');
    Route::patch('/teacheravailable', [TeacherAvailableController::class, 'update'])->name('teacheravailable.update');
});


require __DIR__.'/auth.php';
