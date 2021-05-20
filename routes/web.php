<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
});

//auth route for both
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/logout', [DashboardController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

//route admin
Route::get('/data_masyarakat', [AdminController::class, 'data_masyarakat']);
Route::get('/data_petugas', [AdminController::class, 'data_petugas']);

//route masyarakat
Route::get('/form_pengaduan', [MasyarakatController::class, 'index']);

//Route petugas
Route::get('/beri_tanggapan', [PetugasController::class, 'beri_tanggapan']);

require __DIR__ . '/auth.php';
