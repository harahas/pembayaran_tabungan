@extends('layouts.velonic')
@section('container-velonic')
<style>
    .card-hover,
    .kelas-baru {
        background-color: #1A2942;
        color: antiquewhite
    }

    .card-hover:hover,
    .kelas-baru:hover {
        background-color: white;
        color: #1A2942;
        cursor: pointer;
    }

</style>
<div class="row" id="list-kelas">
    <div class="col-sm-12 mb-2">
        <div class="card text-start">
            <div class="card-header">
                <h4>Kelas 1</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($kelas1 as $row)
                    <div class="col-sm-4">
                        <div class="card card-hover" data-perwalian="{{ $row->bunique }}" data-unique-kelas="{{ $row->unique }}" data-kelas="{{ $row->kelas.$row->huruf }}" unique-guru="{{ $row->cunique }}">
                            <div class="card-body d-flex justify-conten-center flex-column align-items-center">
                                <h3 class="card-title">{{ $row->kelas.$row->huruf }}</h3>
                                @if ($row->nama_guru == null)
                                <p class="card-text">Klik untuk menentukan Wali Kelas</p>
                                @else
                                <p class="card-text">Wali Kelas: {{ $row->nama_guru }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <div class="card text-start">
            <div class="card-header">
                <h4>Kelas 2</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($kelas2 as $row)
                    <div class="col-sm-4">
                        <div class="card card-hover" data-perwalian="{{ $row->bunique }}" data-unique-kelas="{{ $row->unique }}" data-kelas="{{ $row->kelas.$row->huruf }}" unique-guru="{{ $row->cunique }}">
                            <div class="card-body d-flex justify-conten-center flex-column align-items-center">
                                <h3 class="card-title">{{ $row->kelas.$row->huruf }}</h3>
                                @if ($row->nama_guru == null)
                                <p class="card-text">Klik untuk menentukan Wali Kelas</p>
                                @else
                                <p class="card-text">Wali Kelas: {{ $row->nama_guru }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <div class="card text-start">
            <div class="card-header">
                <h4>Kelas 3</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($kelas3 as $row)
                    <div class="col-sm-4">
                        <div class="card card-hover" data-perwalian="{{ $row->bunique }}" data-unique-kelas="{{ $row->unique }}" data-kelas="{{ $row->kelas.$row->huruf }}" unique-guru="{{ $row->cunique }}">
                            <div class="card-body d-flex justify-conten-center flex-column align-items-center">
                                <h3 class="card-title">{{ $row->kelas.$row->huruf }}</h3>
                                @if ($row->nama_guru == null)
                                <p class="card-text">Klik untuk menentukan Wali Kelas</p>
                                @else
                                <p class="card-text">Wali Kelas: {{ $row->nama_guru }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <div class="card text-start">
            <div class="card-header">
                <h4>Kelas 4</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($kelas4 as $row)
                    <div class="col-sm-4">
                        <div class="card card-hover" data-perwalian="{{ $row->bunique }}" data-unique-kelas="{{ $row->unique }}" data-kelas="{{ $row->kelas.$row->huruf }}" unique-guru="{{ $row->cunique }}">
                            <div class="card-body d-flex justify-conten-center flex-column align-items-center">
                                <h3 class="card-title">{{ $row->kelas.$row->huruf }}</h3>
                                @if ($row->nama_guru == null)
                                <p class="card-text">Klik untuk menentukan Wali Kelas</p>
                                @else
                                <p class="card-text">Wali Kelas: {{ $row->nama_guru }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <div class="card text-start">
            <div class="card-header">
                <h4>Kelas 5</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($kelas5 as $row)
                    <div class="col-sm-4">
                        <div class="card card-hover" data-perwalian="{{ $row->bunique }}" data-unique-kelas="{{ $row->unique }}" data-kelas="{{ $row->kelas.$row->huruf }}" unique-guru="{{ $row->cunique }}">
                            <div class="card-body d-flex justify-conten-center flex-column align-items-center">
                                <h3 class="card-title">{{ $row->kelas.$row->huruf }}</h3>
                                @if ($row->nama_guru == null)
                                <p class="card-text">Klik untuk menentukan Wali Kelas</p>
                                @else
                                <p class="card-text">Wali Kelas: {{ $row->nama_guru }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <div class="card text-start">
            <div class="card-header">
                <h4>Kelas 6</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($kelas6 as $row)
                    <div class="col-sm-4">
                        <div class="card card-hover" data-perwalian="{{ $row->bunique }}" data-unique-kelas="{{ $row->unique }}" data-kelas="{{ $row->kelas.$row->huruf }}" unique-guru="{{ $row->cunique }}">
                            <div class="card-body d-flex justify-conten-center flex-column align-items-center">
                                <h3 class="card-title">{{ $row->kelas.$row->huruf }}</h3>
                                @if ($row->nama_guru == null)
                                <p class="card-text">Klik untuk menentukan Wali Kelas</p>
                                @else
                                <p class="card-text">Wali Kelas: {{ $row->nama_guru }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('wali_kelas.modal-perwalian')
<script src="/page-script/wali_kelas.js"></script>
@endsection
