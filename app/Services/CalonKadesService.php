<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Helpers\ArrayResponse;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
class CalonKadesService
{


    static function calonKades($id = 0)
    {
        try {
            $select = [
                'id',
                'nama',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'agama',
                'status_perkawinan',
                'nama_pasangan',
                'visi',
                'misi',
                'moto',
                'foto_blob',
                'foto',
                // DB::raw('CONCAT("' . env('APP_URL') . '", foto) as foto')
            ];
            if ($id <= 0) {
                $result = DB::table('calon_kepala_desa')->select($select)->get();
            } else {
                $result = DB::table('calon_kepala_desa')
                    ->select($select)
                    ->where('id', $id)
                    ->first();
            }
            return ArrayResponse::success('Data calon kepala desa.', $result);
        } catch (\Exception $e) {
            return ArrayResponse::error($e->getMessage());
        }
    }

    static function tambahCalonKades(Request $request): array
    {
        try {
            $imageBiner = null;
            $image_path = "";
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image_name = $image->getClientOriginalName();
                $image->move(public_path('/foto'), $image_name);

                $image_path = "/foto/" . $image_name;

                $imageBiner = $request->image_biner;



                // $imageBiner = Image::make($request->file('foto'));
                // $MY_FILE = $_FILES['foto']['tmp_name'];
                // To open the file and store its contents in $file_contents
                // $file = fopen($MY_FILE, 'r');
                // $file_contents = fread($file, filesize($MY_FILE));
                // fclose($file);
                /* We need to escape some stcharacters that might appear in  file_contents,so do that now, before we begin the query.*/

                // $file_contents = addslashes($file_contents);
            }
            $insert = DB::table('calon_kepala_desa')->insert([
                "nama"              => $request->nama,
                "tempat_lahir"      => $request->tempat_lahir,
                "tanggal_lahir"     => $request->tanggal_lahir,
                "jenis_kelamin"     => $request->jenis_kelamin,
                "agama"             => $request->agama,
                "status_perkawinan" => $request->status_perkawinan,
                "nama_pasangan"     => $request->nama_pasangan,
                "visi"              => $request->visi,
                "misi"              => $request->misi,
                "moto"              => $request->moto,
                "foto"              => $image_path,
                "foto_blob"         => $imageBiner
            ]);

            if ($insert) return AlertFormatter::success("Data berhasil di simpan!");
            return AlertFormatter::warning("Data gagal di simpan!");
        } catch (\Exception $e) {
            return AlertFormatter::danger("Error. " . $e->getMessage());
        }
    }
    static function ubahCalonKades(Request $request, int $id): array
    {
        try {
            $imageBiner = null;
            $image_path = "";
            $data = [
                "nama"              => $request->nama,
                "tempat_lahir"      => $request->tempat_lahir,
                "tanggal_lahir"     => $request->tanggal_lahir,
                "jenis_kelamin"     => $request->jenis_kelamin,
                "agama"             => $request->agama,
                "status_perkawinan" => $request->status_perkawinan,
                "nama_pasangan"     => $request->nama_pasangan,
                "visi"              => $request->visi,
                "misi"              => $request->misi,
                "moto"              => $request->moto,
            ];
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image_name = $image->getClientOriginalName();
                $image->move(public_path('/foto'), $image_name);

                $image_path = "/foto/" . $image_name;

                $data['foto'] = $image_path;
                // $imageBiner = Image::make($request->file('foto'));
                // $MY_FILE = $_FILES['foto']['tmp_name'];
                // To open the file and store its contents in $file_contents
                // $file = fopen($MY_FILE, 'r');
                // $file_contents = fread($file, filesize($MY_FILE));
                // fclose($file);
                /* We need to escape some stcharacters that might appear in  file_contents,so do that now, before we begin the query.*/

                // $file_contents = addslashes($file_contents);
            }
            $insert = DB::table('calon_kepala_desa')
            ->where('id', $id)
            ->update($data);

            if ($insert > 0) return AlertFormatter::success("Data berhasil di simpan!");
            
            return AlertFormatter::warning("Data gagal di simpan!");

        } catch (\Exception $e) {
            return AlertFormatter::danger("Error. " . $e->getMessage());
        }
    }

    public static function hapus($id)
    {

        try {
            
            $delete = DB::table('calon_kepala_desa')->where('id', $id)->delete();

            if ($delete > 0) return AlertFormatter::success("Data berhasil di dihapus!");
            
            return AlertFormatter::warning("Data gagal di dihapus!");

        } catch (\Exception $e) {
            return AlertFormatter::danger("Error. " . $e->getMessage());
        }
    }
}
