<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Services\PemilihService;
use App\Http\Controllers\Controller;
use App\Models\Pemilih;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function masuk(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "nik" => "required|numeric",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return JsonResponse::error([], $validator->errors()->first());
        }

        $pemilih = Pemilih::where('nik', $request->nik)->first();


;
        if (!$pemilih)return JsonResponse::error([], 'NIK belum terdaftar');
        if ($pemilih->status == 0)return JsonResponse::error([], 'Data berlum diverifikasi. Mohon bersabar.');
        if ($pemilih->status == 2)return JsonResponse::error([], 'Data ditolak. Mohon maaf anda tidak dapat mengakses apliasi.');

        if(!Hash::check($request->password, $pemilih->password)) return JsonResponse::error([], 'NIK atau password salah');

        $token = $pemilih->createToken('auth_token')->plainTextToken;
        return JsonResponse::success([
            'user' => $pemilih,
            'token' => $token
        ], 'Berhasil Masuk.');
    }

    public function keluar(Request $request)
    {
        $request->user()->tokens()->delete();
    }
}
