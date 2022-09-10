@extends('admin.templates.template')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('body')


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
                    <h3 class="box-title">Ubah Calon Kades</h3>
                </div>
                <div class="box-body">
                    @include('admin.calon-kepala-desa.form', ['route' => route('calkades.update', $data->id), 'method' => 'PUT', 'data' => $data])
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ asset('assets') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@endsection
