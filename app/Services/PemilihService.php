<?php

namespace App\Services;

use App\Helpers\ArrayResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PemilihService
{
    static function tambahPemilih(Request $request)
    {
        try {
            $date = date('Y-m-d');
            $result = DB::table('pemilih')->insert([
                "nama"  =>  $request->nama,
                "nik"   =>  $request->nik,
                "tempat_lahir" =>  $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "jenis_kelamin"  =>  $request->jenis_kelamin,
                "agama" => $request->agama,
                "no_hp" => $request->no_hp,
                "alamat"  =>  $request->alamat,
                "password" => Hash::make($request->password),
                "created_at" => $date,
                "updated_at" => $date
            ]);
            if ($result)
                return ArrayResponse::success('Data berhasil di simpan.');
            return ArrayResponse::error('Data gagal di simpan');
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }
    static function pemilih(String $key = null, $value = null, bool $all = false)
    {
        try {
            $pemilih = DB::table('pemilih')->select(
                [
                    'id',
                    'nama',
                    'nik',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'jenis_kelamin',
                    'agama',
                    'no_hp',
                    'alamat',
                    'status',
                    'terverifikasi_pada'
                ]
            );
            if ($key != null & $all == false) {
                $pemilih = $pemilih->where($key, '=', $value)
                    ->first();
            }
            else if ($key != null & $all == true) {
                $pemilih = $pemilih->where($key, '=', $value)
                    ->get();
            } else {
                $pemilih = $pemilih->get();
            }
            if ($pemilih)
                return ArrayResponse::success('Data pemilih.', $pemilih);
            return ArrayResponse::error('Gagal mengambil data.');
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }
    static function status(Request $request, $id)
    {
        try {
            $update = DB::table('pemilih')->where('id', $id)->update(['status'=> $request->status, 'terverifikasi_pada' => date('Y-m-d H:i:s')]);
            if($update){
                return ArrayResponse::success('Status berhasil perbarui', $update);
            }
            return ArrayResponse::error('Status gagal di perbarui');
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }
}
