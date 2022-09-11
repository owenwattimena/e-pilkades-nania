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
        <li class="active"><i class="fa fa-user"></i> Periode Pemilihan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Periode Pemilihan</h3>
                </div>
                <div class="box-body">
                    <div style="text-align: right;">
                        <button class="btn btn-primary btn-flat" style="margin-bottom: 15px;" data-toggle="modal" data-target="#modal-default">TAMBAH</button>
                    </div>
                    @php
                        $route = route('periode.create');
                    @endphp
                    <x-periode-dialog type='Tambah' :action="$route"/>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:30px;">No</th>
                                    <th>Masa Jabatan</th>
                                    <th>Tanggal Pemilihan</th>
                                    <th>Jam Mulai Pemilihan</th>
                                    <th>Jam Selesai Pemilihan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($periode as $data)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $data->masa_jabatan }}</td>
                                    <td>{{ $data->tanggal_pemilihan }}</td>
                                    <td>{{ $data->jam_mulai_pemilihan }}</td>
                                    <td>{{ $data->jam_selesai_pemilihan }}</td>
                                    <td> <span class="badge bg-{{ $data->status == 0 ? 'black' : 'green' }}">{{ $data->status == 0 ? 'Tidak Aktif' : 'Aktif' }}</span> </td>
                                    <td>
                                        <a href="{{ route('periode.calonKepalaDesa', $data->id) }}" class="btn btn-xs btn-info">DAFTAR CALON</a>
                                        {{-- <button class="btn btn-xs bg-orange">UBAH</button> --}}
                                        <form action="{{ route('periode.status', $data->id) }}" style="display: initial;" method="POST">
                                            @csrf
                                            @method('post')
                                            @if ($data->status <= 0)
                                            <button class="btn btn-xs bg-green" onclick="return confirm('Yakin ingin aktifkan periode?')">AKTIFKAN</button>
                                            
                                            @else
                                            <button class="btn btn-xs bg-black" onclick="return confirm('Yakin ingin menonaktifkan periode?')">NONAKTIFKAN</button>
                                                
                                            @endif
                                        </form>
                                        <form action="{{ route('periode.delete', $data->id) }}" style="display: initial;" method="POST">
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
