<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Helpers\ArrayResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class untuk proses pemilihan
 */
class PemilihanService
{

    static function checkPilih(Request $request)
    {
        try {
            $pilihan = DB::table('hasil_pemilihan as hp')
                ->join('calon_kades_periode_pemilihan AS ckp', 'hp.calon_kades_periode_pemilihan_id', 'ckp.id')
                ->join('periode_pemilihan AS pp', 'ckp.periode_pemilihan_id', 'pp.id')
                // ->where('hp.calon_kades_periode_pemilihan_id', $idCalonPeriode)
                ->where('hp.pemilih_id', $request->user()->id)
                ->where('pp.status', 1)
                ->exists();
            return ArrayResponse::success("Sudah memilih", $pilihan);
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }

    static function pilih(Request $request)
    {
        try {
            $idPemilih = $request->user()->id;
            $idCalonPeriode = $request->id_calon_periode;

            $pilihan = self::checkPilih($request);
            // return ArrayResponse::success('data', $pilihan);
            if ($pilihan['data']) return ArrayResponse::error("Data pemilihan telah disimpan");


            $date = date('Y-m-d h:m:s');
            if (DB::table('hasil_pemilihan')->insert([
                "calon_kades_periode_pemilihan_id" => $idCalonPeriode,
                "pemilih_id" => $idPemilih,
                "created_at" => $date,
                "updated_at" => $date
            ])) return ArrayResponse::success('Berhasil memilih!', null);

            return ArrayResponse::error('Gagal memilih');
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }

    static function totalSuara()
    {
        try{
            $result =DB::table('hasil_pemilihan AS hp')
                ->select(DB::raw('COUNT(*) as jumlah_suara'))
                ->join('calon_kades_periode_pemilihan AS ckpp', 'hp.calon_kades_periode_pemilihan_id', 'ckpp.id')
                ->join('periode_pemilihan AS pp', 'ckpp.periode_pemilihan_id', 'pp.id')
                ->where('pp.status', 1)->first();
            return ArrayResponse::success('Total Suara!', $result);
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }


    static function hasilPemilihan()
    {
        try {
            $result = DB::table('calon_kades_periode_pemilihan AS ckp')
                ->select(['ckp.id', 'ckd.nama', 'ckd.moto' , 'ckp.nomor_urut', 'pp.id AS id_periode'])
                ->leftJoin('hasil_pemilihan AS hp', 'hp.calon_kades_periode_pemilihan_id', 'ckp.id')
                ->leftJoin('periode_pemilihan AS pp', 'pp.id', 'ckp.periode_pemilihan_id')
                ->leftJoin('calon_kepala_desa AS ckd', 'ckd.id', 'ckp.calon_kades_id')
                ->where('pp.status', 1)
                ->distinct()
                ->get();
            $result->map(function($item){
                $suara = DB::table('hasil_pemilihan AS hp')
                    ->select(DB::raw('COUNT(*) as jumlah_suara'))
                    ->join('calon_kades_periode_pemilihan AS ckp', 'hp.calon_kades_periode_pemilihan_id', 'ckp.id')
                    ->join('periode_pemilihan AS pp', 'pp.id', 'ckp.periode_pemilihan_id')
                    ->where('hp.calon_kades_periode_pemilihan_id', $item->id)
                    ->first();
                $item->jumlah_suara = $suara->jumlah_suara;
                return $item;
            });
            $result = $result->sortByDesc('jumlah_suara')->values();
            return ArrayResponse::success('Hasil Pemilihan!', $result);
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }
}
