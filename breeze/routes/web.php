<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [Auth\AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [Auth\AdminLoginController::class, 'login']);
    Route::post('/logout', [Auth\AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
    });
});

// Patient Routes
Route::prefix('patient')->name('patient.')->group(function () {
    Route::get('/login', [Auth\PatientLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [Auth\PatientLoginController::class, 'login']);
    Route::post('/logout', [Auth\PatientLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:patient')->group(function () {
        Route::get('/home', [PatientHomeController::class, 'index'])->name('home');
    });
});

// Student Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/login', [Auth\StudentLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [Auth\StudentLoginController::class, 'login']);
    Route::post('/logout', [Auth\StudentLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:student')->group(function () {
        Route::get('/home', [StudentHomeController::class, 'index'])->name('home');
    });
});
// Admin Registration Routes
Route::prefix('admin')->group(function () {
    Route::get('/register', [App\Http\Controllers\Auth\AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [App\Http\Controllers\Auth\AdminRegisterController::class, 'register']);
});

// Patient Registration Routes
Route::prefix('patient')->group(function () {
    Route::get('/register', [App\Http\Controllers\Auth\PatientRegisterController::class, 'showRegistrationForm'])->name('patient.register');
    Route::post('/register', [App\Http\Controllers\Auth\PatientRegisterController::class, 'register']);
});

// Student Registration Routes
Route::prefix('student')->group(function () {
    Route::get('/register', [App\Http\Controllers\Auth\StudentRegisterController::class, 'showRegistrationForm'])->name('student.register');
    Route::post('/register', [App\Http\Controllers\Auth\StudentRegisterController::class, 'register']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
