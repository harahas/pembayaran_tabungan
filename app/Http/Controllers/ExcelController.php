<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\AbsenAllExport;
use App\Exports\StudentsExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function test()
    {
        // Logika untuk mengambil data yang ingin diekspor ke Excel
        $students = Student::all();

        // Ekspor ke Excel
        return Excel::download(new StudentsExport($students), 'students.xlsx');
    }

    public function cetak_laporan(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        $bulanan = $request->bulanan;
        $unique_tahun_ajaran = $request->unique_tahun_ajaran;
        $unique_kelas = $request->unique_kelas;
        $hari_ini = $request->hari_ini;
        $cek_tahun = TahunAjaran::where('unique', $unique_tahun_ajaran)->first();
        $cek_kelas = Kelas::where('unique', $unique_kelas)->first();
        if ($request->bulanan != "") {
            if ($bulanan == "ALL") {
                $query = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->join('tahun_ajarans as c', 'a.tahun_ajaran_unique', '=', 'c.unique')
                    ->select('a.student_unique')
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->distinct()
                    ->groupBy('a.student_unique')
                    ->get();
                foreach ($query as $row) {
                    $student = DB::table('students as a')
                        ->join('kelas as b', 'a.kelas', '=', 'b.unique')
                        ->select('a.*', 'b.kelas', 'b.huruf')
                        ->where('a.unique', $row->student_unique)->first();
                    $hadir = DB::table('absen_alls as a')
                        ->join('students as b', 'a.student_unique', '=', 'b.unique')
                        ->select('b.nama', 'a.*')
                        ->where('a.student_unique', $row->student_unique)
                        ->where('a.student_kelas', $request->unique_kelas)
                        ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                        ->where('a.kehadiran', 'H')
                        ->count('a.kehadiran');
                    $sakit = DB::table('absen_alls as a')
                        ->join('students as b', 'a.student_unique', '=', 'b.unique')
                        ->select('b.nama', 'a.*')
                        ->where('a.student_unique', $row->student_unique)
                        ->where('a.student_kelas', $request->unique_kelas)
                        ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                        ->where('a.kehadiran', 'S')
                        ->count('a.kehadiran');
                    $izin = DB::table('absen_alls as a')
                        ->join('students as b', 'a.student_unique', '=', 'b.unique')
                        ->select('b.nama', 'a.*')
                        ->where('a.student_unique', $row->student_unique)
                        ->where('a.student_kelas', $request->unique_kelas)
                        ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                        ->where('a.kehadiran', 'I')
                        ->count('a.kehadiran');
                    $alfa = DB::table('absen_alls as a')
                        ->join('students as b', 'a.student_unique', '=', 'b.unique')
                        ->select('b.nama', 'a.*')
                        ->where('a.student_unique', $row->student_unique)
                        ->where('a.student_kelas', $request->unique_kelas)
                        ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                        ->where('a.kehadiran', 'A')
                        ->count('a.kehadiran');
                    $row->nama = $student->nama;
                    $row->kelas = $student->kelas . $student->huruf;
                    $row->hadir = $hadir;
                    $row->alfa = $alfa;
                    $row->sakit = $sakit;
                    $row->izin = $izin;
                }
                $judul = "Periode  $cek_tahun->tahun_awal-$cek_tahun->tahun_akhir $cek_tahun->periode";
            } else {
                $query = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->select('a.student_unique')
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where(DB::raw("DATE_FORMAT(a.tanggal_absen,'%m')"), $request->bulanan)
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->distinct()
                    ->groupBy('a.student_unique')
                    ->get();
                foreach ($query as $row) {
                    $student = DB::table('students as a')
                        ->join('kelas as b', 'a.kelas', '=', 'b.unique')
                        ->select('a.*', 'b.kelas', 'b.huruf')
                        ->where('a.unique', $row->student_unique)->first();
                    $hadir = DB::table('absen_alls as a')
                        ->join('students as b', 'a.student_unique', '=', 'b.unique')
                        ->select('b.nama', 'a.*')
                        ->where('a.student_unique', $row->student_unique)
                        ->where('a.student_kelas', $request->unique_kelas)
                        ->where(DB::raw("DATE_FORMAT(a.tanggal_absen,'%m')"), $request->bulanan)
                        ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                        ->where('a.kehadiran', 'H')
                        ->count('a.kehadiran');
                    $sakit = DB::table('absen_alls as a')
                        ->join('students as b', 'a.student_unique', '=', 'b.unique')
                        ->select('b.nama', 'a.*')
                        ->where('a.student_unique', $row->student_unique)
                        ->where('a.student_kelas', $request->unique_kelas)
                        ->where(DB::raw("DATE_FORMAT(a.tanggal_absen,'%m')"), $request->bulanan)
                        ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                        ->where('a.kehadiran', 'S')
                        ->count('a.kehadiran');
                    $izin = DB::table('absen_alls as a')
                        ->join('students as b', 'a.student_unique', '=', 'b.unique')
                        ->select('b.nama', 'a.*')
                        ->where('a.student_unique', $row->student_unique)
                        ->where('a.student_kelas', $request->unique_kelas)
                        ->where(DB::raw("DATE_FORMAT(a.tanggal_absen,'%m')"), $request->bulanan)
                        ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                        ->where('a.kehadiran', 'I')
                        ->count('a.kehadiran');
                    $alfa = DB::table('absen_alls as a')
                        ->join('students as b', 'a.student_unique', '=', 'b.unique')
                        ->select('b.nama', 'a.*')
                        ->where('a.student_unique', $row->student_unique)
                        ->where('a.student_kelas', $request->unique_kelas)
                        ->where(DB::raw("DATE_FORMAT(a.tanggal_absen,'%m')"), $request->bulanan)
                        ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                        ->where('a.kehadiran', 'A')
                        ->count('a.kehadiran');
                    $row->nama = $student->nama;
                    $row->kelas = $student->kelas . $student->huruf;
                    $row->hadir = $hadir;
                    $row->alfa = $alfa;
                    $row->sakit = $sakit;
                    $row->izin = $izin;
                }
                if ($bulanan == 1) {
                    $namaBulan = "Januari";
                } elseif ($bulanan == 2) {
                    $namaBulan = "Februari";
                } elseif ($bulanan == 3) {
                    $namaBulan = "Maret";
                } elseif ($bulanan == 4) {
                    $namaBulan = "April";
                } elseif ($bulanan == 5) {
                    $namaBulan = "Mei";
                } elseif ($bulanan == 6) {
                    $namaBulan = "Juni";
                } elseif ($bulanan == 7) {
                    $namaBulan = "Juli";
                } elseif ($bulanan == 8) {
                    $namaBulan = "Agustus";
                } elseif ($bulanan == 9) {
                    $namaBulan = "September";
                } elseif ($bulanan == 10) {
                    $namaBulan = "Oktober";
                } elseif ($bulanan == 11) {
                    $namaBulan = "November";
                } elseif ($bulanan == 12) {
                    $namaBulan = "Desember";
                }
                $judul = "Bulan $namaBulan Periode $cek_tahun->tahun_awal/$cek_tahun->tahun_akhir $cek_tahun->periode";
            }
        } else if ($request->tanggal_awal != null) {
            $query = DB::table('absen_alls as a')
                ->join('students as b', 'a.student_unique', '=', 'b.unique')
                ->select('a.student_unique')
                ->where('a.student_kelas', $request->unique_kelas)
                ->where('a.tanggal_absen', '>=', $request->tanggal_awal)
                ->where('a.tanggal_absen', '<=', $request->tanggal_akhir)
                ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                ->distinct()
                ->groupBy('a.student_unique')
                ->get();
            //QUERY
            foreach ($query as $row) {
                $student = DB::table('students as a')
                    ->join('kelas as b', 'a.kelas', '=', 'b.unique')
                    ->select('a.*', 'b.kelas', 'b.huruf')
                    ->where('a.unique', $row->student_unique)->first();
                $hadir = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->select('b.nama', 'a.*')
                    ->where('a.student_unique', $row->student_unique)
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where('a.tanggal_absen', '>=', $request->tanggal_awal)
                    ->where('a.tanggal_absen', '<=', $request->tanggal_akhir)
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->where('a.kehadiran', 'H')
                    ->count('a.kehadiran');
                $sakit = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->select('b.nama', 'a.*')
                    ->where('a.student_unique', $row->student_unique)
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where('a.tanggal_absen', '>=', $request->tanggal_awal)
                    ->where('a.tanggal_absen', '<=', $request->tanggal_akhir)
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->where('a.kehadiran', 'S')
                    ->count('a.kehadiran');
                $izin = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->select('b.nama', 'a.*')
                    ->where('a.student_unique', $row->student_unique)
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where('a.tanggal_absen', '>=', $request->tanggal_awal)
                    ->where('a.tanggal_absen', '<=', $request->tanggal_akhir)
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->where('a.kehadiran', 'I')
                    ->count('a.kehadiran');
                $alfa = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->select('b.nama', 'a.*')
                    ->where('a.student_unique', $row->student_unique)
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where('a.tanggal_absen', '>=', $request->tanggal_awal)
                    ->where('a.tanggal_absen', '<=', $request->tanggal_akhir)
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->where('a.kehadiran', 'A')
                    ->count('a.kehadiran');
                $row->nama = $student->nama;
                db::table('students as a')->join('kelas as b', 'a.kelas', '=', 'b.unique')->select('a.*', 'b.kelas', 'b.huruf')->where('unique', $row->student_unique)->first();
                $row->kelas = $student->kelas . $student->huruf;
                $row->hadir = $hadir;
                $row->alfa = $alfa;
                $row->sakit = $sakit;
                $row->izin = $izin;
            }
            $judul = tanggal_hari($tanggal_awal) . " - " . tanggal_hari($tanggal_akhir);
        } else if ($request->hari_ini != '0') {
            $query = DB::table('absen_alls as a')
                ->join('students as b', 'a.student_unique', '=', 'b.unique')
                ->select('a.student_unique')
                ->where('a.student_kelas', $request->unique_kelas)
                ->where('a.tanggal_absen', date('Y-m-d', strtotime(Carbon::now())))
                ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                ->distinct()
                ->groupBy('a.student_unique')
                ->get();
            //QUERY
            foreach ($query as $row) {
                $student = DB::table('students as a')
                    ->join('kelas as b', 'a.kelas', '=', 'b.unique')
                    ->select('a.*', 'b.kelas', 'b.huruf')
                    ->where('a.unique', $row->student_unique)->first();
                $hadir = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->select('b.nama', 'a.*')
                    ->where('a.student_unique', $row->student_unique)
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where('a.tanggal_absen', date('Y-m-d', strtotime(Carbon::now())))
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->where('a.kehadiran', 'H')
                    ->count('a.kehadiran');
                $sakit = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->select('b.nama', 'a.*')
                    ->where('a.student_unique', $row->student_unique)
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where('a.tanggal_absen', date('Y-m-d', strtotime(Carbon::now())))
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->where('a.kehadiran', 'S')
                    ->count('a.kehadiran');
                $izin = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->select('b.nama', 'a.*')
                    ->where('a.student_unique', $row->student_unique)
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where('a.tanggal_absen', date('Y-m-d', strtotime(Carbon::now())))
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->where('a.kehadiran', 'I')
                    ->count('a.kehadiran');
                $alfa = DB::table('absen_alls as a')
                    ->join('students as b', 'a.student_unique', '=', 'b.unique')
                    ->select('b.nama', 'a.*')
                    ->where('a.student_unique', $row->student_unique)
                    ->where('a.student_kelas', $request->unique_kelas)
                    ->where('a.tanggal_absen', date('Y-m-d', strtotime(Carbon::now())))
                    ->where('a.tahun_ajaran_unique', $request->unique_tahun_ajaran)
                    ->where('a.kehadiran', 'A')
                    ->count('a.kehadiran');
                $row->nama = $student->nama;
                $row->kelas = $student->kelas . $student->huruf;
                $row->hadir = $hadir;
                $row->alfa = $alfa;
                $row->sakit = $sakit;
                $row->izin = $izin;
            }
            $judul = tanggal_hari(date('Y-m-d', strtotime(Carbon::now())));
        }
        $export = new AbsenAllExport($query);
        $fileName = "Laporan Presensi $judul (Kelas $cek_kelas->kelas$cek_kelas->huruf).xlsx";

        return Excel::download($export, $fileName);
    }
}
