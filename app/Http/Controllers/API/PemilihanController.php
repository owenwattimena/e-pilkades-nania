<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Services\PemilihanService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PemilihanController extends Controller
{
    public function pilih(Request $request)
    {
        $validator = Validator::make($request->input(), [
            "id_calon_periode" => "required"
        ]);

        if($validator->fails()){
            return JsonResponse::error(null, $validator->errors()->first());
        }

        $result = PemilihanService::pilih($request);


        if($result['success']){
            return JsonResponse::success($result['data'], $result['message']);
        }
        return JsonResponse::error($result['data'], $result['message']);
    }

    public function checkPemilihan(Request $request)
    {
        $result = PemilihanService::checkPilih($request);
        return JsonResponse::success($result['data'], $result['message']);
    }

    public function hasilPemilihan(){
        $result = PemilihanService::hasilPemilihan();
        return JsonResponse::success($result['data'], $result['message']);
    }   

    public function totalSuara()
    {
        $result = PemilihanService::totalSuara();
        return JsonResponse::success($result['data'], $result['message']);
    }
}
