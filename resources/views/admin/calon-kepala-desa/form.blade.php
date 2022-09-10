<form action="{{ $route }}" role="form" enctype="multipart/form-data" method="POST">
    @csrf
    @method($method)
    <div class="box-body">

        @if (isset($data) && $data->foto != null)

        <div style="text-align: center">
            <img src="{{ $data->foto }}" width="100" alt="">
        </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama ?? (old('nama') ?? '') }}" required placeholder="Masukan nama">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" {{ isset($required) ? $required : '' }}>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $data->tempat_lahir ?? (old('tempat_lahir') ?? '') }}" required placeholder="Masukan tempat lahir">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $data->tanggal_lahir ?? (old('tanggal_lahir') ?? '') }}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki" {{ isset($data->jenis_kelamin) ? ($data->jenis_kelamin == 'Laki-laki' ? 'selected' : '') : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ isset($data->jenis_kelamin) ? ($data->jenis_kelamin == 'Perempuan' ? 'selected' : '') : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="agama">Agama</label>
            <select class="form-control" id="agama" name="agama" required>
                <option value="">---PILIH AGAMA---</option>
                <option value="Islam" {{isset($data->agama) ? ($data->agama == 'Islam' ? 'selected' : '') : '' }}>Islam</option>
                <option value="Protestan" {{ isset($data->agama) ? ($data->agama == 'Protestan' ? 'selected' : '') : '' }}>Protestan</option>
                <option value="Katolik" {{ isset($data->agama) ? ($data->agama == 'Katolik' ? 'selected' : '') : '' }}>Katolik</option>
                <option value="Hindu" {{ isset($data->agama) ? ($data->agama == 'Hindu' ? 'selected' : '') : '' }}>Hindu</option>
                <option value="Budah" {{ isset($data->agama) ? ($data->agama == 'Budah' ? 'selected' : '') : '' }}>Budah</option>
                <option value="Konghucu" {{ isset($data->agama) ? ($data->agama == 'Konghucu' ? 'selected' : '') : '' }}>Konghucu</option>
            </select>
        </div>
        {{-- <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat">{{ $data->alamat ?? (old('alamat') ?? '') }}</textarea>
    </div> --}}
    <div class="form-group">
        <label for="status_perkawinan">Status Perkawinan</label>
        <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
            <option value="">---PILIH STATUS PERKAWINAN---</option>
            <option value="Belum Kawin" {{isset($data->status_perkawinan) ? ($data->status_perkawinan == 'Belum Kawin' ? 'selected' : '') : '' }}>Belum Kawin</option>
            <option value="Kawin" {{isset($data->status_perkawinanama) ? ($data->status_perkawinan == 'Kawin' ? 'selected' : '') : '' }}>Kawin</option>
            <option value="Cerai Hidup" {{isset($data->status_perkawinan) ? ($data->status_perkawinan == 'Cerai Hidup' ? 'selected' : '') : '' }}>Cerai Hidup</option>
            <option value="Cerai Mati" {{isset($data->status_perkawinan) ? ($data->status_perkawinan == 'Cerai Mati' ? 'selected' : '') : '' }}>Cerai Mati</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nama_pasangan">Nama Pasangan</label>
        <input type="text" class="form-control" id="nama_pasangan" name="nama_pasangan" value="{{ $data->nama_pasangan ?? (old('nama_pasangan') ?? '') }}" required placeholder="Masukan nama pasangan">
    </div>
    <div class="form-group">
        <label for="visi">Visi</label>
        <textarea type="text" class="form-control" id="visi" name="visi" placeholder="Masukan visi">{{ $data->visi ?? (old('visi') ?? '') }}</textarea>
    </div>
    <div class="form-group">
        <label for="misi">Misi</label>
        <textarea type="text" class="form-control" id="misi" name="misi" placeholder="Masukan misi">{{ $data->misi ?? (old('misi') ?? '') }}</textarea>
    </div>
    <div class="form-group">
        <label for="moto">Moto</label>
        <input type="text" class="form-control" id="moto" name="moto" value="{{ $data->moto ?? (old('moto') ?? '') }}" required placeholder="Masukan moto">
    </div>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
