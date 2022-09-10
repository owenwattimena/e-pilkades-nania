<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\CalonKadesService;
use Illuminate\Http\Request;

class CalonKadesController extends Controller
{
    public function calonKades($id)
    {
        $calonKades = CalonKadesService::calonKades($id);
        return JsonResponse::success($calonKades['data'], 'Data calon kades.');
    }
}
