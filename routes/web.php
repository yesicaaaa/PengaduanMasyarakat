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

//route masyarakat
Route::group(['middleware' => ['auth']], function() {
    Route::get('/form_pengaduan', [MasyarakatController::class, 'index']);
    Route::post('/proses_pengaduan', [MasyarakatController::class, 'proses_pengaduan']);
    Route::get('/pengaduan_saya', [MasyarakatController::class, 'pengaduan_saya']);
    Route::get('/tanggapan_pengaduan/{id}', [MasyarakatController::class, 'tanggapan_pengaduan']);
});

//route admin
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/data_masyarakat', [AdminController::class, 'data_masyarakat']);
    Route::get('/data_petugas', [AdminController::class, 'data_petugas']);
    Route::get('/beri_tanggapan_view_admin', [AdminController::class, 'tanggapan']);
    Route::get('/beri_tanggapan_admin/{id}', [AdminController::class, 'beri_tanggapan']);
    Route::post('/kirim_tanggapan_admin', [AdminController::class, 'kirim_tanggapan']);
    Route::get('/generate_laporan', [AdminController::class, 'generate_laporan']); 
    Route::get('/soft-delete/{id}', [AdminController::class, 'soft_delete']);
    Route::get('/trash', [AdminController::class, 'trash']);
    Route::get('/restore/{id}', [AdminController::class, 'restore']);
    Route::get('/restore_all', [AdminController::class, 'restore_all']);
    Route::get('/delete/{id}', [AdminController::class, 'delete']);
    Route::get('/delete_permanent', [AdminController::class, 'delete_all']);
});

//route petugas
Route::group(['middleware' => ['auth', 'role:petugas']], function () {
    Route::get('/beri_tanggapan_view_petugas', [PetugasController::class, 'tanggapan']);
    Route::get('/beri_tanggapan_petugas/{id}', [PetugasController::class, 'beri_tanggapan']);
    Route::post('/kirim_tanggapan_petugas', [PetugasController::class, 'kirim_tanggapan']);
});

require __DIR__ . '/auth.php';
