<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\CalonKadesService;
use App\Services\PeriodeService;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periodeResult = PeriodeService::periode();

        $data['periode'] = $periodeResult['data'];

        return view('admin.periode.index', $data);
    }
  
    public function create(Request $request)
    {
        $result = PeriodeService::tambahPeriode($request);
  
        if($result['success'])
        {
            return redirect()->back()->with(AlertFormatter::success($result['message']));
        }
        return redirect()->back()->with(AlertFormatter::danger($result['message']));
    }

    public function calonKepalaDesa($id){
        $calonKades = CalonKadesService::calonKades();
        $periode = PeriodeService::periode($id);
        $calonKadesPeriode = PeriodeService::calonKadesPeriode($id);
        $data['id'] = $id;
        $data['calonKades'] = $calonKades['data'];
        $data['calonKadesPeriode'] = $calonKadesPeriode['data'];
        $data['periode'] = $periode['data'];
        return view('admin.periode.calon-kades', $data);
    }

    public function registrasiCalonKades(Request $request, $id)
    {
        $request->validate([
            'nomor_urut' => 'required',
            'id_calon_kades' => 'required|numeric'
        ]);

        $registerCalonKades = PeriodeService::registrasiCalonKades($request, $id);
        if($registerCalonKades['success'])
            return redirect()->back()->with(AlertFormatter::success($registerCalonKades['message']));
        return redirect()->back()->with(AlertFormatter::danger($registerCalonKades['message']));
    }

    public function delete(Request $request, $id)
    {
        $result = PeriodeService::hapus($id);
        return redirect()->back()->with($result);
    }

    public function status(Request $request, $id)
    {
        $result = PeriodeService::status($id);
        return redirect()->back()->with($result);
    }
    public function deleteCalkades(Request $request, $id)
    {
        $result = PeriodeService::hapusCalkades($id);
        return redirect()->back()->with($result);
    }
}
