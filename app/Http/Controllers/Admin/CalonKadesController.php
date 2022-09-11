<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\CalonKadesService;
use App\Http\Controllers\Controller;

class CalonKadesController extends Controller
{
    public function index(){
        $calonKades = CalonKadesService::calonKades();
        $data['calonKades'] = $calonKades['data'];
        return view('admin.calon-kepala-desa.index', $data);
    }

    public function create()
    {
        return view('admin.calon-kepala-desa.tambah');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            // 'alamat' => 'required|string',
            'status_perkawinan' => 'required|string',
            'nama_pasangan' => 'required|string',
            'visi' => 'required',
            'misi' => 'required',
            'moto' => 'required'
        ]);
        
        $result = CalonKadesService::tambahCalonKades($request);

        if($result['status'] == 'success')
        {
            return redirect()->route('calkades')->with($result);
        }
        return redirect()->back()->with($result);
    }

    public function edit($id)
    {
        $calonKades = CalonKadesService::calonKades($id);
        $data = [];
        if($calonKades['success']){
            $data['data'] = $calonKades['data'];
        }
        return view('admin.calon-kepala-desa.ubah', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            // 'alamat' => 'required|string',
            'status_perkawinan' => 'required|string',
            'nama_pasangan' => 'required|string',
            'visi' => 'required',
            'misi' => 'required',
            'moto' => 'required'
        ]);

        $result = CalonKadesService::ubahCalonKades($request, $id);
        

        if($result['status'] == 'success')
        {
            return redirect()->route('calkades')->with($result);
        }
        return redirect()->back()->with($result);
    }

    public function delete(Request $request, $id)
    {
        $result = CalonKadesService::hapus($id);

        if($result['status'] == 'success')
        {
            return redirect()->route('calkades')->with($result);
        }
        return redirect()->back()->with($result);
    }
}
