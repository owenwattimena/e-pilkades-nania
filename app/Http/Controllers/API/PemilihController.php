<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Services\PemilihService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PemilihController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nik' => 'required|unique:pemilih|min:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'password' => 'required|confirmed',
        ]);

        
        if ($validator->fails()) {
            return JsonResponse::error(null, $validator->errors()->first());
        }

        $result = PemilihService::tambahPemilih($request);

        if($result['success'])
        {
            return JsonResponse::success([], 'Pendaftaran behasil. Data anda akan segera di verifikasi.');
        }
        return JsonResponse::error([], $result['message'], 500);

    }
}
