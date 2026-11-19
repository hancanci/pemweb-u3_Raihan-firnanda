
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;

// ==========================================
// BERANDA
// ==========================================

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// ==========================================
// LOGIN DAN REGISTER
// ==========================================

Route::middleware('guest')->group(function () {

    // Halaman Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    // Proses Login
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');


    // Halaman Register
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    // Proses Register
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

});


// ==========================================
// LOGOUT
// ==========================================

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// ==========================================
// DASHBOARD
// ==========================================

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // ======================================
    // CRUD ARTIKEL
    // ======================================

    // Menampilkan semua artikel
    Route::get('/articles', [ArticleController::class, 'index'])
        ->name('articles.index');

    // Form tambah artikel
    Route::get('/articles/create', [ArticleController::class, 'create'])
        ->name('articles.create');

    // Menyimpan artikel
    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('articles.store');

    // Form edit artikel
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
        ->name('articles.edit');

    // Memperbarui artikel
    Route::put('/articles/{article}', [ArticleController::class, 'update'])
        ->name('articles.update');

    // Menghapus artikel
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy');

});


// ==========================================
// DETAIL ARTIKEL
// DAPAT DIAKSES TANPA LOGIN
// ==========================================

Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('articles.show');

