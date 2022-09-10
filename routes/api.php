<?php

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PemilihController;
use App\Http\Controllers\API\PemilihanController;
use App\Http\Controllers\API\PeriodeController;
use App\Http\Controllers\API\CalonKadesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('masuk', [AuthController::class, 'masuk']);
    Route::post('daftar', [PemilihController::class, 'register']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('keluar', [AuthController::class, 'keluar']);
        Route::get('calon-kepala-desa', [PeriodeController::class, 'calonKadesPeriode']);
        Route::get('calon-kepala-desa/{id}', [CalonKadesController::class, 'calonKades']);
        Route::get('periode-aktif', [PeriodeController::class, 'periodeAktif']);
        Route::post('pemilihan', [PemilihanController::class, 'pilih']);
        Route::get('pemilihan-check', [PemilihanController::class, 'checkPemilihan']);
        Route::get('hasil-pemilihan', [PemilihanController::class, 'hasilPemilihan']);
        Route::get('user', function(Request $request){
            return JsonResponse::success($request->user(), "User.");
        });
    });
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
