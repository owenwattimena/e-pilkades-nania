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
        Periode Pemilihan
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-user"></i> Daftar Calon Kepala Desa</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Calon Kepala Desa</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Masa Jabatan</th>
                                <td>{{ $periode->masa_jabatan }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pemilihan</th>
                                <td>{{ $periode->tanggal_pemilihan }}</td>
                            </tr>
                            <tr>
                                <th>Jam Mulai Pemilihan</th>
                                <td>{{ $periode->jam_mulai_pemilihan }}</td>
                            </tr>
                            <tr>
                                <th>Jam Selesai Pemilihan</th>
                                <td>{{ $periode->jam_selesai_pemilihan }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td> <span class="badge bg-{{ $periode->status == 0 ? 'black' : 'green'}}">{{ $periode->status == 0 ? 'Tidak Aktif' : 'Aktif'}}</span> </td>
                            </tr>
                        </table>
                    </div>
                    <div style="text-align: right;">
                        <button class="btn btn-primary btn-flat" style="margin-bottom: 15px;" data-toggle="modal" data-target="#modal-default">TAMBAH</button>
                    </div>
                    @php
                    $route = route('periode.calonKepalaDesa.registrasi', $id);
                    @endphp
                    <x-calon-kades-periode-dialog type='Tambah' :action="$route" :calonkades="$calonKades" />
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:30px;">No</th>
                                    <th>Foto</th>
                                    <th>Nomor Urut</th>
                                    <th>Nama</th>
                                    <th>Moto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($calonKadesPeriode as $data)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td><img src="{{ asset($data->foto) }}" width="30" alt=""></td>
                                    <td>{{ $data->nomor_urut }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->moto }}</td>
                                    <td>
                                        <form action="{{ route('periode.calkades-periode.hapus', $data->id) }}" style="display: initial;" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-xs bg-red" onclick="return confirm('Yakin ingin menghapus data?')">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
