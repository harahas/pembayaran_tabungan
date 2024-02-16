<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // $formatHariIni = date('Y-m-d');
        $hariIni = Carbon::now();
        $formatHariIni = $hariIni->format('Y-m-d');
        // return ($formatHariIni);
        // Total Seluruh Wajib
        $totalSeluruhWajibMasuk = Tabungan::where('jenis_tabungan', 'wajib')->sum('masuk');
        $totalSeluruhWajibkeluar = Tabungan::where('jenis_tabungan', 'wajib')->sum('keluar');
        $totalAllWajib = $totalSeluruhWajibMasuk - $totalSeluruhWajibkeluar;
        // Total Seluruh Sukarela
        $totalSeluruhSukarelaMasuk = Tabungan::where('jenis_tabungan', 'Sukarela')->sum('masuk');
        $totalSeluruhSukarelakeluar = Tabungan::where('jenis_tabungan', 'Sukarela')->sum('keluar');
        $totalAllSukarela = $totalSeluruhSukarelaMasuk - $totalSeluruhSukarelakeluar;
        // Total Seluruh Transport
        $totalSeluruhTransportMasuk = Tabungan::where('jenis_tabungan', 'Transport')->sum('masuk');
        $totalSeluruhTransportkeluar = Tabungan::where('jenis_tabungan', 'Transport')->sum('keluar');
        $totalAllTransport = $totalSeluruhTransportMasuk - $totalSeluruhTransportkeluar;
        // Tabungan Wajib Harian
        $tabunganWajib = Tabungan::where('tanggal', $formatHariIni)
            ->where('jenis_tabungan', 'wajib');
        $masuk = $tabunganWajib->sum('masuk');
        $keluar = $tabunganWajib->sum('keluar');
        $totalWajib = $masuk - $keluar;
        // Tabungan Sukarela Harian
        $tabunganSukarela = Tabungan::where('tanggal', $formatHariIni)
            ->where('jenis_tabungan', 'sukarela');
        $masuk = $tabunganSukarela->sum('masuk');
        $keluar = $tabunganSukarela->sum('keluar');
        $totalSukarela = $masuk - $keluar;
        // Tabungan Transport Harian
        $tabunganTransport = Tabungan::where('tanggal', $formatHariIni)
            ->where('jenis_tabungan', 'transport');
        $masuk = $tabunganTransport->sum('masuk');
        $keluar = $tabunganTransport->sum('keluar');
        $totalTransport = $masuk - $keluar;
        $data = [
            'title_page' => 'Dashborad',
            'title' => 'Dashborad',
            'data_guru' => Teacher::count('id'),
            'data_siswa' => Student::count('id'),
            'jumlah_tabungan_wajib' => $totalWajib,
            'jumlah_tabungan_sukarela' => $totalSukarela,
            'jumlah_tabungan_transport' => $totalTransport,
            'totalWajib' => $totalAllWajib,
            'totalSukarela' => $totalAllSukarela,
            'totalTransport' => $totalAllTransport
        ];
        if (auth()->user()->role == 'SISWA') {
            return redirect('/tabunganSiswa');
        }
        return view('dashboard.index', $data);
    }
}
