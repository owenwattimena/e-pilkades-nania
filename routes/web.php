<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PemilihController;
use App\Http\Controllers\Admin\CalonKadesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Auth\AuthController;

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

Route::get('/', function(){
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {

    Route::get('/masuk', [AuthController::class, 'login'])->name('login');
    Route::post('/masuk', [AuthController::class, 'doLogin'])->name('login.do');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/keluar', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/calon-kepala-desa')->group(function () {
        Route::get('/', [CalonKadesController::class, 'index'])->name('calkades');
        Route::get('/tambah', [CalonKadesController::class, 'create'])->name('calkades.tambah');
        Route::post('/tambah', [CalonKadesController::class, 'store'])->name('calkades.simpan');
        Route::get('/ubah/{id}', [CalonKadesController::class, 'edit'])->name('calkades.edit');
        Route::put('/ubah/{id}', [CalonKadesController::class, 'update'])->name('calkades.update');
        Route::delete('hapus/{id}', [CalonKadesController::class, 'delete'])->name('calkades.delete');

    });
    Route::get('/calon-kepala-desa/{id}', function ($id) {
        echo $id;
    })->name('calkades1');

    Route::prefix('pemilih')->group(function () {
        Route::get('/', [PemilihController::class, 'index'])->name('pemilih');
        Route::get('/{id}', [PemilihController::class, 'detail'])->name('pemilih.detail');
        Route::post('/{id}/verifikasi', [PemilihController::class, 'status'])->name('pemilih.verifikasi');
        Route::post('/{id}/tolak', [PemilihController::class, 'status'])->name('pemilih.tolak');
    });

    Route::prefix('periode')->group(function () {
        Route::get('/', [PeriodeController::class, 'index'])->name('periode');
        Route::get('{id}/daftar-calon/', [PeriodeController::class, 'calonKepalaDesa'])->name('periode.calonKepalaDesa');
        Route::post('{id}/daftar-calon/', [PeriodeController::class, 'registrasiCalonKades'])->name('periode.calonKepalaDesa.registrasi');
        Route::post('/', [PeriodeController::class, 'create'])->name('periode.create');
    });
    Route::get('/user', function () {
        // return view('admin.login');
    })->name('user');
});
