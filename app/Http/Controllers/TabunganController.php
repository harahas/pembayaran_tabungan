<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-unique="' . $row->unique . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-unique="' . $row->unique . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
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
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-unique="' . $row->unique . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-unique="' . $row->unique . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
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
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-unique="' . $row->unique . '"><i class="fas fa-edit"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger text-white delete-button" title="Hapus Data" data-unique="' . $row->unique . '" data-token="' . csrf_token() . '"><i class="fas fa-trash-alt"></i></button>';
            return $actionBtn;
        })->make(true);
    }
}
