<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Services\PeriodeService;
use App\Services\PemilihanService;
use App\Http\Controllers\Controller;

class PeriodeController extends Controller
{
    public function calonKadesPeriode()
    {
        $calonKadesPeriodeAktif = PeriodeService::calonKadesPeriodeAktif();
        return JsonResponse::success($calonKadesPeriodeAktif['data'], 'Daftar Calon Kepala Desa periode aktif');
    }

    public function periodeAktif(Request $request)
    {
        $periodeAktif = PeriodeService::periodeAktif();
        $statusPemilihan = PemilihanService::checkPilih($request);
        return JsonResponse::success([
            "periode_aktif" => $periodeAktif['data'],
            "sudah_memilih" => $statusPemilihan['data']
        ], 'Periode aktif');
    }
}
