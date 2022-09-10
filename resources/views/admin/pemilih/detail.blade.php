@extends('admin.templates.template')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('body')

<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pemilih
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-user"></i> Pemilih</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Detail Pemilih</h3>
                </div>
                <div class="box-body">
                    <span class="badge bg-{{ $pemilih->status == 0 ? 'orange' : ($pemilih->status == 1 ? 'green' : 'red') }}" style="font-size: 14px; margin-bottom: 15px;">{{ $pemilih->status == 0 ? 'Belum Diverifikasi' : ($pemilih->status == 1 ? 'Terverifikasi' : 'Ditolak') }}</span>
                    @if($pemilih->terverifikasi_pada == null)
                    <p style="margin-bottom: 0">
                        Lakukan verifikasi data pemilih agar pemilih dapat mengakses login di app E-Pilkades Nania (Mobile)
                    </p>
                    <p style="margin-bottom: 0">
                        Pastikan pemilih yang hendak di verifikasi adalah warga Desa Nania.
                    </p>
                    <p>
                        Jika pemilih bukan warga Desa Nania klik tombol "TOLAK"
                    </p>
                    <div style="text-align: right; margin-bottom: 15px">
                        <form action="{{ route('pemilih.verifikasi', $pemilih->id) }}" method="post" style="display: inline">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn bg-green btn-social"><i class="fa fa-check"></i> VERIFIKASI</button>
                        </form>
                        <form action="{{ route('pemilih.tolak', $pemilih->id) }}" method="post" style="display: inline">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn bg-red btn-social"><i class="fa fa-ban"></i> TOLAK</button>
                        </form>
                    </div>
                    @endif
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="nama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="nama" value="{{ $pemilih->nama }}" readonly disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-sm-2 control-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nik" value="{{ $pemilih->nik }}" readonly disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ttl" class="col-sm-2 control-label">TTL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ttl" value="{{ $pemilih->tempat_lahir }}, {{ $pemilih->tanggal_lahir }}" readonly disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jenis_kelamin" value="{{ $pemilih->jenis_kelamin }}" readonly disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agama" class="col-sm-2 control-label">Agama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="agama" value="{{ $pemilih->agama }}" readonly disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="col-sm-2 control-label">No HP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_hp" value="{{ $pemilih->no_hp }}" readonly disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="alamat" readonly disabled>{{ $pemilih->alamat }}</textarea>
                            </div>
                        </div>
                        @if($pemilih->status > 0)
                        <div class="form-group">
                            <label for="verfikasi" class="col-sm-2 control-label">{{ $pemilih->status == 1 ? 'Diverifikasi Pada' : 'Ditolak Pada' }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="verfikasi" value="{{ $pemilih->terverifikasi_pada }}" readonly disabled>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- /.content-wrapper -->
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ asset('assets') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@endsection
