@extends('admin.templates.template')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('body')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @auth
        Selamat datang, {{auth()->user()->name}}</br>
        @endauth
        <small>E-PILKADES NANIA</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-tachometer"></i> Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $terdaftar }}</h3>
                    <p>Pemilih Terdaftar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $terverifikasi }}</h3>
                    <p>Pemilih Terverifikasi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-body">
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    @if (isset($periode->masa_jabatan))
                    <strong>Perolehan Suara</strong>
                    <address>
                        Periode {{ $periode->masa_jabatan }}<br>
                        Tanggal Pemilihan {{ $periode->tanggal_pemilihan }}<br>
                        Jam Pemilihan {{ $periode->jam_mulai_pemilihan }} s/d {{ $periode->jam_selesai_pemilihan }}<br>
                        Jumlah Peserta Pemilih
                    </address>
                    @endif
                </div>
            </div>
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Nomor Urut</th>
                    <th>Nama</th>
                    <th>Moto</th>
                    <th>Jumlah Suara</th>
                    <th>Persentase</th>
                </thead>
                <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @foreach ($pemilihan as $item)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $item->nomor_urut }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->moto }}</td>
                        <td>{{ $item->jumlah_suara }}</td>
                        <td>{{ $terverifikasi != 0 ? ($item->jumlah_suara / $terverifikasi * 100) : 0 }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection

@section('script')
<script src="https://d3js.org/d3.v3.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('assets') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@endsection
