<!-- Modal -->
<div class="modal fade" id="modal-generate-tagihan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ml-3" id="title-modal">Generate Tagihan Periode <span class="title-periode-tagihan"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> <!-- end modal header -->
            <div class="modal-body" style="padding:0 2em">
                <div class="row mt-2 mb-2">
                    <div class="col-12">
                        <div class="card" style="border-radius:20px">
                            <div class="card-header" style="border-radius:20px 20px 0 0">
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive-sm p-2">
                                <table id="table-generate" class="table table-bordered table-sm table-striped" style="overflow-y:scroll;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">Kelas</th>
                                            <th colspan="{{ $count_jenis }}" class="text-center">Jenis Tagihan</th>
                                            <th rowspan="2" class="text-center">Action</th>
                                        </tr>
                                        <tr>
                                            @foreach ($jenis as $row)
                                            @php
                                            $cek = DB::table('setting_tagihans')->where('unique_jenis_pembayaran', $row->unique)->first();
                                            @endphp
                                            @if($cek)
                                            <th>{{ $row->jenis_pembayaran }}</th>
                                            @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelas as $row)
                                        <tr>
                                            <td>{{ $row->kelas.$row->huruf }}</td>
                                            <form action="javascript:;">
                                                <input type="hidden" name="unique_tahun_ajaran" id="unique-tahun-ajaran">
                                                <input type="hidden" name="unique_kelas" value="{{ $row->unique }}">
                                                @foreach ($jenis as $row2)
                                                @php
                                                $cek = DB::table('setting_tagihans')->where('unique_jenis_pembayaran', $row2->unique)->first();
                                                @endphp
                                                @if($cek)
                                                <td><input type="checkbox" name="jenis[]" value="{{ $row2->unique }}"></td>
                                                @endif
                                                @endforeach
                                                <td class="text-center"><button type="button" class="btn btn-primary" id="btn-generate" title="Cari Siswa"><i class="ri-zoom-in-line"></i></button></td>
                                            </form>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="btn-action"></div>
        </div>
    </div>
</div>
