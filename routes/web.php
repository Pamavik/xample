<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherAvailableController;
use App\Http\Controllers\TeacherUsersController;
use App\Http\Controllers\XampleController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AnaliticController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\Xample;
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

Route::get('/analitic', [AnaliticController::class, 'index']);

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
    Route::resource('xamples', XampleController::class);
    Route::get('xample/{xample_id}', function ($xample_id) {
        return Inertia::render('Teacher/Xample', [
            'xample' => Xample::find($xample_id)
        ]);
    })->name('xample');
    Route::resource('groups', GroupController::class);
    Route::get('users', [TeacherUsersController::class, 'index'])->name('users');
    Route::get('user', [TeacherUsersController::class, 'showUser'])->name('user');
    Route::put('user', [TeacherUsersController::class, 'updateUser'])->name('updateuser');
    Route::put('usergroup', [TeacherUsersController::class, 'updateUserGroup'])->name('updateusergroup');
})->middleware(['auth', 'user-access:teacher']);

Route::middleware('auth', 'user-access:user')->group(function () {
    Route::get('/teacheravailable', [TeacherAvailableController::class, 'index'])->name('teacheravailable.index');
    Route::patch('/teacheravailable', [TeacherAvailableController::class, 'update'])->name('teacheravailable.update');
});

Route::middleware('auth')->group(function () {
    Route::resource('results', ResultController::class);
});


require __DIR__.'/auth.php';
