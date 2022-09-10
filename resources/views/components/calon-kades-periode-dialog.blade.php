<div>
    @push('style')
    <link rel="stylesheet" href="{{  asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{  asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da !important;
            padding: 0.46875rem 0.75rem !important;
            height: calc(2.21rem + 2px) !important;
        }

    </style>
    @endpush
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Daftarkan Calon Kepala Desa</h4>
                </div>
                <form action="{{ $action }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nomor_urut">Nomor Urut</label>
                                <input type="text" class="form-control" id="nomor_urut" name="nomor_urut" placeholder="Masukan nomor urut">
                            </div>
                            <div class="form-group">
                                <label>Calon Kepala Desa</label>
                                <select class="form-control select2" style="width: 100%;" name="id_calon_kades">
                                    @foreach ($calonkades as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @section('script')
    <script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2();

    </script>
    @endsection
</div>
