@extends('layouts.velonic')
@section('container-velonic')
<div class="row">
    <div class="col-xxl-3 col-sm-4">
        <div class="card widget-flat text-bg-info">
            <div class="card-body">
                <div class="float-end">
                    <h3><i class="mdi mdi-account-group"></i></h3>
                </div>
                <h6 class="text-uppercase mt-0" title="Siswa">Jumlah Siswa</h6>
                <h2 class="my-2">{{ $data_siswa}}</h2>
                <p class="mb-0">
                    <span class="text-nowrap"><a href="/student" class="small-box-footer text-white fst-italic">More info... <i class="fas fa-arrow-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-4">
        <div class="card widget-flat text-bg-success">
            <div class="card-body">
                <div class="float-end">
                    <h3><i class="mdi mdi-account-group"></i></h3>
                </div>
                <h6 class="text-uppercase mt-0" title="Guru">Jumlah Guru</h6>
                <h2 class="my-2">{{ $data_guru}}</h2>
                <p class="mb-0">
                    <span class="text-nowrap"><a href="/student" class="small-box-footer text-white fst-italic">More info... <i class="fas fa-arrow-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>
    <hr>
    <h4>Tabungan Siswa</h4>
    <br>
    <br>
    {{-- <div class="col-xxl-3 col-sm-3">
        <div class="card widget-flat text-bg-light">
            <div class="card-body">
                <div class="float-end">
                    <i class="ri-eye-line widget-icon"></i>
                </div>
                <h5 class="text ri-coins-fill fw-normal fs-20 align-middle me-1" title="Guru">Jumlah Tabungan</h5>
                <h6 class="badge bg-secondary-subtle text-secondary rounded-pill " title="Guru">Wajib</h6>
                <h2 class="my-2">{{ rupiah($totalWajib)}}</h2>
    <p class="mb-0">
        <span class="text-nowrap"><a href="/student" class="small-box-footer text-white fst-italic">More info... <i class="fas fa-arrow-circle-right"></i></a></span>
    </p>
</div>
</div>
</div> --}}

<div class="row">
    <div class="col-xxl-3 col-sm-4">
        <div class="card widget-flat text-bg-purple">
            <div class="card-body">
                <div class="float-end">
                    <h3><i class="ri-coins-fill"></i></h3>
                </div>
                <h5 class="badge bg-secondary-subtle text-purple rounded-pill " title="Guru">Wajib</h5>
                <h5 class="text mt-0" title="Siswa">Jumlah Harian</h5>
                <h2 class="my-2">{{ rupiah($jumlah_tabungan_wajib)}}</h2>
                <hr>
                <h5 class="text mt-0" title="Siswa">Jumlah Seluruh</h5>
                <h4 class="my-2">{{ rupiah($totalWajib)}}</h4>

                <p class="mb-0">
                    <span class="text-nowrap"><a href="/student" class="small-box-footer text-white fst-italic">More info... <i class="fas fa-arrow-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-4">
        <div class="card widget-flat text-bg-pink">
            <div class="card-body">
                <div class="float-end">
                    <h3><i class="ri-hand-heart-line"></i></h3>
                </div>
                <h5 class="badge bg-secondary-subtle text-purple rounded-pill " title="Guru">Sukarela</h5>
                <h5 class="text mt-0" title="Siswa">Jumlah Harian</h5>
                <h2 class="my-2">{{ rupiah($jumlah_tabungan_sukarela)}}</h2>
                <hr>
                <h5 class="text mt-0" title="Siswa">Jumlah Seluruh</h5>
                <h4 class="my-2">{{ rupiah($totalSukarela)}}</h4>

                <p class="mb-0">
                    <span class="text-nowrap"><a href="/student" class="small-box-footer text-white fst-italic">More info... <i class="fas fa-arrow-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-4">
        <div class="card widget-flat text-bg-secondary">
            <div class="card-body">
                <div class="float-end">
                    <h3><i class="ri-bus-2-fill"></i></h3>
                </div>
                <h5 class="badge bg-secondary-subtle text-purple rounded-pill " title="Guru">Transport</h5>
                <h5 class="text mt-0" title="Siswa">Jumlah Harian</h5>
                <h2 class="my-2">{{ rupiah($jumlah_tabungan_transport)}}</h2>
                <hr>
                <h5 class="text mt-0" title="Siswa">Jumlah Seluruh</h5>
                <h4 class="my-2">{{ rupiah($totalTransport)}}</h4>

                <p class="mb-0">
                    <span class="text-nowrap"><a href="/student" class="small-box-footer text-white fst-italic">More info... <i class="fas fa-arrow-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>


</div>
</div>
@endsection
{{-- <!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $data_siswa}}</h3>

<p>Data Siswa</p>
</div>
<div class="icon">
    <i class="ion ion-bag"></i>
</div>
<a href="/student" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $data_guru }}</sup></h3>

            <p>Data Guru</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="/teacher" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
</div> --}}
