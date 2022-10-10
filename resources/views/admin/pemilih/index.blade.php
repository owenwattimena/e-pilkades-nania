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
                    <h3 class="box-title">Daftar Pemilih</h3>
                </div>
                <div class="box-body">
                    <div style="text-align: right;">
                        <a href="{{ route('calkades.tambah') }}" class="btn btn-primary" style="border-radius: 0; margin-bottom: 15px;">TAMBAH</a>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:30px;">No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>TTL</th>
                                    <th>Status</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($pemilih as $data)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $data->nik }}</td>
                                    <td>{{ $data->nama }}</td>
                                    {{-- <td>{{ $data->nik }}</td> --}}
                                    <td>{{ $data->tempat_lahir }}, {{ $data->tanggal_lahir }}</td>
                                    <td>{!! ($data->status == 0 ? '<span class="badge bg-orange"> Belum Terverifikasi </span>' : ( $data->status == 1 ? '<span class="badge bg-green">Terverifikasi</span>' : '<span class="badge bg-red">Ditolak</span>')) !!}</td>
                                    <td>
                                        <a href="{{ route('pemilih.detail', $data->id) }}" class="btn btn-xs bg-green">DETAIL</a>
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
<script>
    $('#table').DataTable(
        {paging:false}
    );
</script>
@endsection
