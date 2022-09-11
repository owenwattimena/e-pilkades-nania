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
        Calon Kepala Desa
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-user"></i> Calon Kades</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Calon Kades</h3>
                </div>
                <div class="box-body">
                    <div style="text-align: right;">
                        <a href="{{ route('calkades.tambah') }}" class="btn btn-primary" style="border-radius: 0; margin-bottom: 15px;">TAMBAH</a>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:30px;">No</th>
                                    <th style="width:30px;">Foto</th>
                                    <th>Nama</th>
                                    {{-- <th>NIK</th> --}}
                                    <th>TTL</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 0;
                                dump($calonKades);
                                @endphp
                                @foreach ($calonKades as $data)
                                <tr>
                                    <td>{{ ++$no}}</td>
                                    <td><img src="{{ asset($data->foto) }}" width="30" alt=""></td>
                                    <td>{{ $data->nama }}</td>
                                    {{-- <td>{{ $data->nik }}</td> --}}
                                    <td>{{ $data->tempat_lahir }}, {{ $data->tanggal_lahir }}</td>
                                    <td>
                                        {{-- <a href="" class="btn btn-xs bg-green">DETAIL</a> --}}
                                        <a href="{{ route('calkades.edit', $data->id) }}" class="btn btn-xs bg-yellow">UBAH</a>
                                        <form action="{{ route('calkades.delete', $data->id) }}" style="display: initial;" method="POST">
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
