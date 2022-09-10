<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PemilihService;
use App\Services\PeriodeService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pemilihTerdaftar = PemilihService::pemilih();
        $pemilihTerverifkasi = PemilihService::pemilih('status', 1, true);
        $data['terdaftar'] = count($pemilihTerdaftar['data']);
        $data['terverifikasi'] = count($pemilihTerverifkasi['data']);

        $periode = PeriodeService::periodeAktif();
        $data['periode'] = $periode['data'];
        // dd($data);
        return view('admin.dashboard', $data);
    }
}
