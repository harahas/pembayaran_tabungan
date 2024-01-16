<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Teacher;
use App\Models\WaliKelas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaliKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title_page' => 'Wali Kelas',
            'title' => 'Data Wali Kelas',
            'kelas1' => DB::table('kelas as a')
                ->join('wali_kelas as b', 'a.unique', '=', 'b.unique_kelas', 'left')
                ->join('teachers as c', 'b.unique_teacher', '=', 'c.unique', 'left')
                ->select('a.*', 'b.unique as bunique', 'c.unique as cunique', 'c.nama_guru')
                ->where('a.kelas', 1)->get(),
            'kelas2' => DB::table('kelas as a')
                ->join('wali_kelas as b', 'a.unique', '=', 'b.unique_kelas', 'left')
                ->join('teachers as c', 'b.unique_teacher', '=', 'c.unique', 'left')
                ->select('a.*', 'b.unique as bunique', 'c.unique as cunique', 'c.nama_guru')
                ->where('kelas', 2)->get(),
            'kelas3' => DB::table('kelas as a')
                ->join('wali_kelas as b', 'a.unique', '=', 'b.unique_kelas', 'left')
                ->join('teachers as c', 'b.unique_teacher', '=', 'c.unique', 'left')
                ->select('a.*', 'b.unique as bunique', 'c.unique as cunique', 'c.nama_guru')
                ->where('kelas', 3)->get(),
            'kelas4' => DB::table('kelas as a')
                ->join('wali_kelas as b', 'a.unique', '=', 'b.unique_kelas', 'left')
                ->join('teachers as c', 'b.unique_teacher', '=', 'c.unique', 'left')
                ->select('a.*', 'b.unique as bunique', 'c.unique as cunique', 'c.nama_guru')
                ->where('a.kelas', 4)->get(),
            'kelas5' => DB::table('kelas as a')
                ->join('wali_kelas as b', 'a.unique', '=', 'b.unique_kelas', 'left')
                ->join('teachers as c', 'b.unique_teacher', '=', 'c.unique', 'left')
                ->select('a.*', 'b.unique as bunique', 'c.unique as cunique', 'c.nama_guru')
                ->where('kelas', 5)->get(),
            'kelas6' => DB::table('kelas as a')
                ->join('wali_kelas as b', 'a.unique', '=', 'b.unique_kelas', 'left')
                ->join('teachers as c', 'b.unique_teacher', '=', 'c.unique', 'left')
                ->select('a.*', 'b.unique as bunique', 'c.unique as cunique', 'c.nama_guru')
                ->where('kelas', 6)->get(),
        ];
        return view('wali_kelas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WaliKelas $waliKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaliKelas $waliKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaliKelas $waliKelas)
    {
        //
    }

    public function update_perwalian(Request $request)
    {

        $teacher = Teacher::where('unique', $request->unique_teacher)->first();
        if ($request->unique == "") {
            $data = [
                'unique' => Str::orderedUuid(),
                'unique_kelas' => $request->unique_kelas,
                'unique_teacher' => $request->unique_teacher,
            ];
            WaliKelas::create($data);
            return response()->json([
                'success' => 'Wali Kelas Berhasil Ditambahkan',
                'guru' => $teacher->nama_guru
            ]);
        } else {
            $data = [
                'unique_kelas' => $request->unique_kelas,
                'unique_teacher' => $request->unique_teacher,
            ];
            WaliKelas::where('unique', $request->unique)->update($data);
            return response()->json([
                'success' => 'Wali Kelas Berhasil Diubah',
                'guru' => $teacher->nama_guru
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaliKelas $waliKelas)
    {
        //
    }

    public function get_wali(Request $request)
    {
        return response()->json(['data' => Teacher::all()]);
    }
}
