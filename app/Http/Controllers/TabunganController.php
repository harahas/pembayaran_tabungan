<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\Tabungan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TabunganController extends Controller
{
    //
    public function index()
    {
        $data = [
            'title_page' => 'Input',
            'title' => 'Data Tabungan',
            'siswa' => Student::orderBy('nama', 'asc')
                ->get(),
        ];
        return view('tabungan.index', $data);
    }
    public function dataTableSukarela(Request $request)
    {
        // jika semua im=nputan kosong 
        if ($request->unique_student == '' && $request->tgl_awal == '' && $request->tgl_akhir == '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'sukarela')
                ->get();
        } else if ($request->unique_student != '' && $request->tgl_awal == '' && $request->tgl_akhir == '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'sukarela')
                ->where('unique_student', $request->unique_student)
                ->get();
        } else if ($request->unique_student != '' && $request->tgl_awal != '' && $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'sukarela')
                ->where('unique_student', $request->unique_student)
                ->where('a.tanggal', '>=', $request->tgl_awal)
                ->where('a.tanggal', '<=', $request->tgl_akhir)
                ->get();
        } else if ($request->unique_student != '' && $request->tgl_awal != '' || $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'sukarela')
                ->where('unique_student', $request->unique_student)
                ->get();
        } else if ($request->unique_student == '' && $request->tgl_awal != '' && $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'sukarela')
                ->where('a.tanggal', '>=', $request->tgl_awal)
                ->where('a.tanggal', '<=', $request->tgl_akhir)
                ->get();
        } else if ($request->unique_student == '' && $request->tgl_awal != '' || $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'sukarela')
                ->get();
        }
        foreach ($query as $row) {
            $row->masuk = rupiah($row->masuk);
            $row->keluar = rupiah($row->keluar);
            $row->tanggal = tanggal_hari($row->tanggal);
        }
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-unique="' . $row->unique . '"><i class="ri-edit-line"></i></button>
                    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-unique="' . $row->unique . '" data-token="' . csrf_token() . '"><i class="ri-delete-bin-line"></i></button>';
            return $actionBtn;
        })->make(true);
    }
    public function dataTableWajib(Request $request)
    {
        // jika semua im=nputan kosong 
        if ($request->unique_student == '' && $request->tgl_awal == '' && $request->tgl_akhir == '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'wajib')
                ->get();
        } else if ($request->unique_student != '' && $request->tgl_awal == '' && $request->tgl_akhir == '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'wajib')
                ->where('unique_student', $request->unique_student)
                ->get();
        } else if ($request->unique_student != '' && $request->tgl_awal != '' && $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'wajib')
                ->where('unique_student', $request->unique_student)
                ->where('a.tanggal', '>=', $request->tgl_awal)
                ->where('a.tanggal', '<=', $request->tgl_akhir)
                ->get();
        } else if ($request->unique_student != '' && $request->tgl_awal != '' || $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'wajib')
                ->where('unique_student', $request->unique_student)
                ->get();
        } else if ($request->unique_student == '' && $request->tgl_awal != '' && $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'wajib')
                ->where('a.tanggal', '>=', $request->tgl_awal)
                ->where('a.tanggal', '<=', $request->tgl_akhir)
                ->get();
        } else if ($request->unique_student == '' && $request->tgl_awal != '' || $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'wajib')
                ->get();
        }
        foreach ($query as $row) {
            $row->masuk = rupiah($row->masuk);
            $row->keluar = rupiah($row->keluar);
            $row->tanggal = tanggal_hari($row->tanggal);
        }
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-unique="' . $row->unique . '"><i class="ri-edit-line"></i></button>
                    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-unique="' . $row->unique . '" data-token="' . csrf_token() . '"><i class="ri-delete-bin-line"></i></button>';
            return $actionBtn;
        })->make(true);
    }
    public function dataTableTransport(Request $request)
    {
        // jika semua im=nputan kosong 
        if ($request->unique_student == '' && $request->tgl_awal == '' && $request->tgl_akhir == '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'transport')
                ->get();
        } else if ($request->unique_student != '' && $request->tgl_awal == '' && $request->tgl_akhir == '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'transport')
                ->where('unique_student', $request->unique_student)
                ->get();
        } else if ($request->unique_student != '' && $request->tgl_awal != '' && $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'transport')
                ->where('unique_student', $request->unique_student)
                ->where('a.tanggal', '>=', $request->tgl_awal)
                ->where('a.tanggal', '<=', $request->tgl_akhir)
                ->get();
        } else if ($request->unique_student != '' && $request->tgl_awal != '' || $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'transport')
                ->where('unique_student', $request->unique_student)
                ->get();
        } else if ($request->unique_student == '' && $request->tgl_awal != '' && $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'transport')
                ->where('a.tanggal', '>=', $request->tgl_awal)
                ->where('a.tanggal', '<=', $request->tgl_akhir)
                ->get();
        } else if ($request->unique_student == '' && $request->tgl_awal != '' || $request->tgl_akhir != '') {
            $query = DB::table('tabungans as a')
                ->join('students as b', 'a.unique_student', '=', 'b.unique')
                ->select('a.*', 'b.nama')
                ->where('a.jenis_tabungan', 'transport')
                ->get();
        }
        foreach ($query as $row) {
            $row->masuk = rupiah($row->masuk);
            $row->keluar = rupiah($row->keluar);
            $row->tanggal = tanggal_hari($row->tanggal);
        }
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
                    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-unique="' . $row->unique . '"><i class="ri-edit-line"></i></button>
                    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-unique="' . $row->unique . '" data-token="' . csrf_token() . '"><i class="ri-delete-bin-line"></i></button>';
            return $actionBtn;
        })->make(true);
    }
    public function tambahDataNabung(Request $request)
    {
        $rules = [
            // RULES DIAMBIL DARI INPUTAN NAME 
            'unique_student' => 'required',
            'jenis_tabungan' => 'required',
            'tanggal' => 'required',
            'masuk' => 'required',
            'keluar' => 'required',
        ];
        $pesan = [
            'unique_student.required' => 'Silahkan Memilih Salah Satu Siswa',
            'jenis_tabungan.required' => 'Silahkan Pilih Tabungan',
            'tanggal.required' => 'Silahkan Pilih Tanggal',
            'masuk.required' => 'Tidak Boleh Kosong',
            'keluar.required' => 'Tidak Boleh Kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        // KETIKA ADA YANG TIDAK VALID
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        } else {
            $sumMasuk = Tabungan::where('unique_student', $request->unique_student)
                ->where('jenis_tabungan', $request->jenis_tabungan)->sum('masuk');
            $sumKeluar = Tabungan::where('unique_student', $request->unique_student)
                ->where('jenis_tabungan', $request->jenis_tabungan)->sum('keluar');
            if (($sumMasuk - $sumKeluar) < $request->keluar) {
                return response()->json(['kurang' => 'Saldo Tidak Mencukupi Untuk Melakukan Penarikan']);
            }
            $data = [
                'unique' => Str::orderedUuid(),
                'unique_student' => $request->unique_student,
                'jenis_tabungan' => $request->jenis_tabungan,
                'masuk' => $request->masuk,
                'keluar' => $request->keluar,
                'tanggal' => $request->tanggal,
            ];
            Tabungan::create($data);
            return response()->json(['success' => 'Data Berhasil di simpan']);
        }
    }
    public function ambilSaldo(Request $request)
    {
        //5 = (1 x 4) + 1
        $cek = Tabungan::where('unique_student', $request->unique_student)->first();
        if ($cek) {
            $sukarela = Tabungan::where('unique_student', $request->unique_student)->where('jenis_tabungan', 'sukarela');
            $wajib = Tabungan::where('unique_student', $request->unique_student)->where('jenis_tabungan', 'wajib');
            $transport = Tabungan::where('unique_student', $request->unique_student)->where('jenis_tabungan', 'transport');
            $saldoSukarela = $sukarela->sum('masuk') - $sukarela->sum('keluar');
            $saldoTransport = $transport->sum('masuk') - $transport->sum('keluar');
            $saldoWajib = $wajib->sum('masuk') - $wajib->sum('keluar');
        } else {
            $saldoSukarela = 0;
            $saldoTransport = 0;
            $saldoWajib = 0;
        }
        return response()->json([
            'saldoSukarela' => rupiah($saldoSukarela),
            'saldoWajib' => rupiah($saldoWajib),
            'saldoTransport' => rupiah($saldoTransport),
        ]);
    }
}
