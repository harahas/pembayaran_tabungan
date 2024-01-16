@extends('layouts.velonic')
@section('container-velonic')
<div class="row">
    <div class="col-12 mb-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-guru" id="btn-add-data">
            <i class="ri-add-box-line"></i>&nbsp;<span>Tambah Data</span>
        </button>
    </div>
    <div class="col-12">
        <div class="card" style="border-radius:20px">
            <div class="card-header" style="border-radius:20px 20px 0 0">
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive-sm">
                <table id="table-guru" class="table table-centered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPK</th>
                            <th>Nama Guru</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
{{-- Modal Siswa --}}
@include('teacher.modal-tambah-data')
<script src="/page-script/guru.js"></script>
@endsection
