<!-- Modal -->
<div class="modal fade" id="modal-tabungan-siswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ml-3" id="title-modal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> <!-- end modal header -->
            <div class="modal-body" style="padding:0 2em">
                <form action="javascript:;" id="form-nabung">
                    @csrf
                    <input type="hidden" name="current_unique" id="current_unique">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mt-2">
                                <label for="pilih-siswa" class="form-label">Pilih Siswa</label>
                                <select class="form-control " name="unique_student" id="unique_student">
                                    <option value="" selected disabled>Pilih Siswa</option>
                                    @foreach ($siswa as $row)
                                    <option value="{{ $row->unique }}">{{ $row->nis.' - '.$row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="jenis_tabungan">Jenis Tabungan</label>
                                <select class="form-control" name="jenis_tabungan" id="jenis_tabungan">
                                    <option selected disabled value="">Pilih Jenis Pembayaran</option>
                                    <option value="wajib">wajib</option>
                                    <option value="sukarela">sukarela</option>
                                    <option value="transport">transport</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal">
                            </div>
                            <div class="form-group mt-2">
                                <label for="masuk">Masuk</label>
                                <input type="text" class="form-control" name="masuk" id="masuk" value="0">
                            </div>
                            <div class="form-group mt-2">
                                <label for="keluar">Keluar</label>
                                <input type="text" class="form-control" name="keluar" id="keluar" value="0">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mt-3" id="btn-action"></div>
        </div>
    </div>
</div>
