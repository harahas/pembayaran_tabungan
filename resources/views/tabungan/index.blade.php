@extends('layouts.velonic')
@section('container-velonic')
<div class="row">
    <div class="col-12 mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-jenis-pembayaran" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Input Tabungan</span>
        </button>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2>Daftar Tabungan</h2>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 mt-2">
                                <label for="pilih-siswa" class="form-label">Pilih Siswa</label>
                                <select class="form-control select2 js-states" data-toggle="select2" id="pilih-siswa">
                                    <option></option>
                                    @foreach ($siswa as $row)
                                    <option value="{{ $row->unique }}">{{ $row->nis.' - '.$row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 mt-2">
                                <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tgl_awal">
                            </div>
                            <div class="col-sm-4 mt-2">
                                <label for="tgl_akhir" class="form-label">Tanggal zAkhir</label>
                                <input type="date" class="form-control" id="tgl_akhir">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card border-secondary border p-2">
                            <div class="row">
                                <div class="col-6">
                                    <small>Jenis Tabungan</small>
                                    <p><i class="ri-file-paper-2-fill"></i>&nbsp;Sukarela</p>
                                </div>
                                <div class="col-6" style="border-left: 1px solid grey">
                                    <small>Saldo</small>
                                    <p><i class=" ri-wallet-3-fill"></i>&nbsp; <span id="saldo-sukarela">-</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card border-secondary border p-2">
                            <div class="row">
                                <div class="col-6">
                                    <small>Jenis Tabungan</small>
                                    <p><i class="ri-file-paper-2-fill"></i>&nbsp;Wajib</p>
                                </div>
                                <div class="col-6" style="border-left: 1px solid grey">
                                    <small>Saldo</small>
                                    <p><i class=" ri-wallet-3-fill"></i>&nbsp; <span id="saldo-wajib">-</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card border-secondary border p-2">
                            <div class="row">
                                <div class="col-6">
                                    <small>Jenis Tabungan</small>
                                    <p><i class="ri-file-paper-2-fill"></i>&nbsp;Transport</p>
                                </div>
                                <div class="col-6" style="border-left: 1px solid grey">
                                    <small>Saldo</small>
                                    <p><i class=" ri-wallet-3-fill"></i>&nbsp; <span id="saldo-transport">-</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="basicwizard">
                    <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                        <li class="nav-item">
                            <a href="#basictab2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2" id="tab2">
                                <i class="ri-coins-fill fw-normal fs-20 align-middle me-1"></i>
                                <span class="d-none d-sm-inline">Wajib</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#basictab1" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2" id="tab1">
                                <i class=" ri-hand-heart-line fw-normal fs-20 align-middle me-1"></i>
                                <span class="d-none d-sm-inline">Sukarela</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#basictab3" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2" id="tab3">
                                <i class=" ri-bus-2-fill fw-normal fs-20 align-middle me-1"></i>
                                <span class="d-none d-sm-inline">Transport</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content b-0 mb-0">
                        <div class="tab-pane" id="basictab1">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table-tabungan-sukarela">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Masuk</th>
                                                    <th>Keluar</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="basictab2">
                            <div class="card">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table-tabungan-wajib">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Masuk</th>
                                                    <th>Keluar</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="daftar-tagihan-lunas">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="basictab3">
                            <div class="card">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table-tabungan-transport">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Masuk</th>
                                                    <th>Keluar</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- tab-content -->
                </div> <!-- end #basicwizard-->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@include('/tabungan.modal-tabungan')
<script src="/page-script/tabungan.js"></script>
@endsection
