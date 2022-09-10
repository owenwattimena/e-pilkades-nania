<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use Illuminate\Http\Request;
use App\Services\PemilihService;
use App\Http\Controllers\Controller;

class PemilihController extends Controller
{
    public function index()
    {
        $pemilihService = PemilihService::pemilih();
        $data['pemilih'] = $pemilihService['data'];
        return view('admin.pemilih.index', $data);
    }

    public function detail(int $id)
    {
        $pemilihService = PemilihService::pemilih('id', $id);
        $data['pemilih'] = $pemilihService['data'];
        return view('admin.pemilih.detail', $data);
    }

    public function status(Request $request, $id)
    {
        $statusUpdate = PemilihService::status($request, $id);
        if($statusUpdate['success']){
            return redirect()->route('pemilih')->with(AlertFormatter::success($statusUpdate['message']));
        }
        return redirect()->back()->with(AlertFormatter::danger($statusUpdate['message']));
    }
}
