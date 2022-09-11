<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\PemilihService;
use App\Services\PeriodeService;
use App\Services\PemilihanService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $pemilihTerdaftar = PemilihService::pemilih();
        $pemilihTerverifkasi = PemilihService::pemilih('status', 1, true);
        $data['terdaftar'] = count($pemilihTerdaftar['data']);
        $data['terverifikasi'] = count($pemilihTerverifkasi['data']);

        $periode = PeriodeService::periodeAktif();
        $pemilihan = PemilihanService::hasilPemilihan();
        $data['periode'] = $periode['data'];
        $data['pemilihan'] = $pemilihan['data'];
        // dd($data);
        return view('admin.dashboard', $data);
    }
}
