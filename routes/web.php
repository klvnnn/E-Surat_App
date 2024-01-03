<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LetterinController;
use App\Http\Controllers\Admin\PanduanController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', [LoginController::class, 'index']);

// Authentication
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//Register
// Route::get('/register', [RegisterController::class, 'index'])->name('register');
// Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


//Admin
Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('/letter', LetterController::class, [
            'except' => ['show']
        ]);
        //Surat Masuk
        Route::get('letter/create-masuk', [LetterinController::class, 'create'])->name('create-masuk');
        Route::post('letter/create-masuk', [LetterinController::class, 'store'])->name('letterin.store');
        Route::get('letter/surat-masuk', [LetterinController::class, 'incoming_mail'])->name('surat-masuk');
        Route::get('letter/surat-masuk/{id}', [LetterinController::class, 'show'])->name('detail-surat-masuk');
        Route::get('letter/surat-masuk/{id}/edit', [LetterinController::class, 'edit'])->name('letterin.edit');
        Route::put('letter/surat-masuk/{id}', [LetterinController::class, 'update'])->name('letterin.update');
        Route::delete('letter/surat-masuk/{id}/delete', [LetterinController::class, 'destroy'])->name('letterin.destroy');
        Route::get('letter/reset-in', [LetterinController::class, 'reset_in'])->name('reset-letter-in');
        
        //Surat Keluar
        Route::get('letter/create-keluar', [LetterController::class, 'keluar'])->name('create-keluar');
        Route::get('letter/surat-keluar', [LetterController::class, 'outgoing_mail'])->name('surat-keluar');
        Route::get('letter/surat-keluar/{id}', [LetterController::class, 'show'])->name('detail-surat');
        Route::delete('letter/surat-keluar/{id}/delete', [LetterController::class, 'destroy'])->name('letter.destroy');
        Route::get('letter/reset-out', [LetterController::class, 'reset_out'])->name('reset-letter-out');
        
        //print
        Route::get('print/surat-masuk', [PrintController::class, 'index'])->name('print-surat-masuk');
        Route::get('print/surat-keluar', [PrintController::class, 'outgoing'])->name('print-surat-keluar');
        //Print Disposisi
        Route::get('print/disposisi/{id}', [PrintController::class, 'disposisi'])->name('print-disposisi');

        //Panduan
        Route::get('letter/panduan', [PanduanController::class, 'index'])->name('panduan');
        Route::get('letter/panduan/create', [PanduanController::class, 'create'])->name('create-panduan');
        Route::post('letter/panduan/create', [PanduanController::class, 'store'])->name('panduan.store');
        Route::get('letter/panduan/{id}/edit', [PanduanController::class, 'edit'])->name('panduan.edit');
        Route::put('letter/panduan/{id}', [PanduanController::class, 'update'])->name('panduan.update');
        Route::delete('letter/panduan/{id}/delete', [PanduanController::class, 'destroy'])->name('panduan.destroy');

        Route::resource('user', UserController::class);
        Route::delete('user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');
        Route::resource('setting', SettingController::class, [
            'except' => ['show']
        ]);
        Route::get('setting/password', [SettingController::class, 'change_password'])->name('change-password');
        Route::post('change-password', [SettingController::class, 'update_password'])->name('update.password');
        // Route::post('setting/upload-profile', [SettingController::class, 'upload_profile'])->name('profile-upload');
    });
