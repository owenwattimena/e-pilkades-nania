<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Helpers\ArrayResponse;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class PeriodeService
{
    static function calonKadesPeriodeAktif()
    {
        try {
            $result = DB::table('calon_kades_periode_pemilihan AS kp')
                ->join('periode_pemilihan as p', 'p.id', 'kp.periode_pemilihan_id')
                ->join('calon_kepala_desa AS cd', 'kp.calon_kades_id', 'cd.id')
                ->select(
                    [
                        'cd.id',
                        'kp.nomor_urut',
                        'kp.id as id_calkades_periode',
                        'cd.nama',
                        'cd.moto',
                        // DB::raw('CONCAT("' . env('APP_URL') . '", cd.foto) AS foto'),
                        'cd.foto'
                    ]
                )
                ->where('p.status', 1)
                ->get();
            return ArrayResponse::success('Data calon kades periode', $result);
        } catch (\Throwable $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }

    static function calonKadesPeriode($id)
    {
        try {
            $result = DB::table('calon_kades_periode_pemilihan AS kp')
                ->join('calon_kepala_desa AS cd', 'kp.calon_kades_id', 'cd.id')
                ->select(
                    [
                        'kp.id',
                        'kp.nomor_urut',
                        'cd.nama',
                        'cd.moto',
                        'cd.foto'
                    ]
                )
                ->where('kp.periode_pemilihan_id', $id)
                ->get();
            return ArrayResponse::success('Data calon kades periode', $result);
        } catch (\Throwable $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }

    static function periodeAktif()
    {
        try {

            $result = DB::table('periode_pemilihan')
                ->select([
                    'id', 'masa_jabatan', 'tanggal_pemilihan', 'jam_mulai_pemilihan', 'jam_selesai_pemilihan', 'status'
                ])
                ->where('status', 1)->first();

            if ($result) {
                return ArrayResponse::success('Data Periode', $result);
            }
            return ArrayResponse::error('Gagal mengambil data periode');
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }

    static function periode($id = 0)
    {
        try {
            if ($id == 0) {
                $result = DB::table('periode_pemilihan')->get();
            } else {
                $result = DB::table('periode_pemilihan')->where('id', $id)->first();
            }
            if ($result) {
                return ArrayResponse::success('Data Periode', $result);
            }
            return ArrayResponse::error('Gagal mengambil data periode');
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }

    static function tambahPeriode(Request $request)
    {
        try {
            DB::beginTransaction();

            $periode = self::periode();
            if (count($periode['data']) > 0) {
                $nonaktifkanStatus = DB::table('periode_pemilihan')->where('status', 1)->update([
                    'status' => 0
                ]);

                if ($nonaktifkanStatus == false)
                    return ArrayResponse::error("Gagal menonaktifkan status periode.");
            }

            $date = date('Y-m-d H:i:s');
            $request = DB::table('periode_pemilihan')->insert([
                "masa_jabatan" => $request->masa_jabatan,
                "tanggal_pemilihan" => $request->tanggal_pemilihan,
                "jam_mulai_pemilihan"   => $request->jam_mulai_pemilihan,
                "jam_selesai_pemilihan"   => $request->jam_selesai_pemilihan,
                "status"    => 1,
                "created_at" => $date,
                "updated_at" => $date
            ]);

            if (!$request) {
                DB::rollBack();
                return ArrayResponse::error("Data gagal ditambahkan.");
            }
            DB::commit();

            return ArrayResponse::success('Data berhasil ditambahkan', null);
        } catch (\Exception $e) {
            return ArrayResponse::error("Eror. " . $e->getMessage());
        }
    }

    static function registrasiCalonKades(Request $request, $id)
    {
        try {
            $result = DB::table('calon_kades_periode_pemilihan')->insert([
                'calon_kades_id' => $request->id_calon_kades,
                'periode_pemilihan_id' => $id,
                'nomor_urut' => $request->nomor_urut
            ]);
            if ($result) return ArrayResponse::success('Registrasi calon kades berhasil.', $result);
            return ArrayResponse::error('Registrasi calojn kades gagal.');
        } catch (\Exception $e) {
            return ArrayResponse::error('Error. ' . $e->getMessage());
        }
    }

    public static function hapus($id)
    {
        try {
            $delete = DB::table('periode_pemilihan')->where('id', $id)->delete();

            if ($delete > 0) return AlertFormatter::success("Data berhasil di dihapus!");

            return AlertFormatter::warning("Data gagal di dihapus!");
        } catch (\Exception $e) {
            return AlertFormatter::danger("Error. " . $e->getMessage());
        }
    }

    public static function status($id)
    {
        try {
            $data = DB::table('periode_pemilihan')->where('id', $id)->first();
            DB::beginTransaction();
            // jika status = aktif
            if ($data->status == 1) {
                if (DB::table('periode_pemilihan')->where('id', $id)->update([
                    'status' => 0
                ]) > 0) {
                    DB::commit();
                    return AlertFormatter::success("Status berhasil di ubah!");
                }
                DB::rollBack();
                return AlertFormatter::warning("Status gagal di ubah!");
            }
            // jika status = tidak aktif
            else {
                $nonaktif = DB::table('periode_pemilihan')->where('status', 1)->update([
                    'status' => 0
                ]);

                if (DB::table('periode_pemilihan')->where('id', $id)->update([
                    'status' => 1
                ]) > 0) {
                    DB::commit();
                    return AlertFormatter::success("Status berhasil di ubah!");
                }

                DB::rollBack();
                return AlertFormatter::warning("Status gagal di ubah!");
            }
        } catch (\Throwable $e) {
            return AlertFormatter::danger("Error. " . $e->getMessage());
        }
    }

    public static function hapusCalkades($id)
    {
        try {
            $delete = DB::table('calon_kades_periode_pemilihan')->where('id', $id)->delete();

            if ($delete > 0) return AlertFormatter::success("Data berhasil di dihapus!");

            return AlertFormatter::warning("Data gagal di dihapus!");
        } catch (\Exception $e) {
            return AlertFormatter::danger("Error. " . $e->getMessage());
        }
    }
}
