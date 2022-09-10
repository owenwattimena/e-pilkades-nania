<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $type }} Periode</h4>
                </div>
                <form action="{{ $action }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="masa_jabatan">Masa Jabatan</label>
                                <input type="text" class="form-control" id="masa_jabatan" name="masa_jabatan" placeholder="Masukan masa jabatan. Cth [2021-2022]">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pemilihan">Tanggal Pemilihan</label>
                                <input type="date" class="form-control" id="tanggal_pemilihan" name="tanggal_pemilihan">
                            </div>
                            <div class="form-group">
                                <label for="jam_mulai_pemilihan">Jam Mulai Pemilihan</label>
                                <input type="time" class="form-control" id="jam_mulai_pemilihan" name="jam_mulai_pemilihan">
                            </div>
                            <div class="form-group">
                                <label for="jam_selesai_pemilihan">Jam Selesai Pemilihan</label>
                                <input type="time" class="form-control" id="jam_selesai_pemilihan" name="jam_selesai_pemilihan">
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
</div>
