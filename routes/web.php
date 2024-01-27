<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatpelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AbsenAllController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\HistoriKelasController;
use App\Http\Controllers\TagihanSiswaController;
use App\Http\Controllers\SettingTagihanController;
use App\Http\Controllers\GenerateTagihanController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\LaporanPresensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware('admin');
Route::get('/home', [DashboardController::class, 'index'])->middleware('admin');
Route::resource("/user", AuthController::class)->middleware('admin');
Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::get('/auth', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->middleware('admin');
Route::post('/registerUser', [AuthController::class, 'register_user'])->middleware('admin');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/changePassword', [AuthController::class, 'change_password'])->middleware('admin');

//SISWA
Route::resource('/student', StudentController::class)->middleware('admin');
Route::get('/historiKelas', [StudentController::class, 'cek_histori_kelas'])->middleware('admin');
//GURU
Route::resource('/teacher', TeacherController::class)->middleware('admin');
//Refresh Ampuan
Route::get('/refresh_ampuan', [TeacherController::class, 'refresh_ampuan'])->middleware('admin');
//Tambah dan Hapus Ampuan
Route::get('/tambah_ampuan', [TeacherController::class, 'tambah_ampuan'])->middleware('admin');
Route::get('/hapus_ampuan', [TeacherController::class, 'hapus_ampuan'])->middleware('admin');




// WALI KELAS
Route::resource('/wali_kelas', WaliKelasController::class)->middleware('admin');
Route::get('/getWali', [WaliKelasController::class, 'get_wali'])->middleware('admin');
Route::POST('/updateWaliKelas', [WaliKelasController::class, 'update_perwalian'])->middleware('admin');



//TAHUN AJARAN
Route::resource('/tahun_ajaran', TahunAjaranController::class)->middleware('admin');
Route::get('/changeTahunAjaran', [TahunAjaranController::class, 'tahun_aktif'])->middleware('admin');
Route::get('/refreshTahunAjaran', [TahunAjaranController::class, 'refresh_tahun_aktif'])->middleware('admin');

//KELAS
Route::resource('/kelas', KelasController::class)->middleware('admin');



//ROLES
Route::resource('/roles', RoleController::class)->middleware('admin');

//JENIS PEMBAYARAN
Route::resource('/jenis_pembayaran', JenisPembayaranController::class)->middleware('admin');

//GENERATE TAGIHAN
Route::resource('/generate_tagihan', GenerateTagihanController::class)->middleware('admin');
Route::get('/cekSettingTagihan', [GenerateTagihanController::class, 'cek_setting_tagihan'])->middleware('admin');
Route::get('/generateTagihan', [GenerateTagihanController::class, 'generate_tagihan'])->middleware('admin');

//TAGIHAN SISWA
Route::resource('/tagihan_siswa', TagihanSiswaController::class)->middleware('admin');
Route::get('/pilihSiswa', [TagihanSiswaController::class, 'pilih_siswa'])->middleware('admin');
Route::get('/getDataTagihan', [TagihanSiswaController::class, 'get_data_tagihan'])->middleware('admin');
Route::get('/getDataTagihanLunas', [TagihanSiswaController::class, 'get_data_tagihan_lunas'])->middleware('admin');
Route::get('/cekCurrentTagihan', [TagihanSiswaController::class, 'cek_tagihan_terbayar'])->middleware('admin');

//SETTING TAGIHAN
Route::resource('/setting_tagihan', SettingTagihanController::class)->middleware('admin');
Route::get('/updateNominal', [SettingTagihanController::class, 'update_nominal'])->middleware('admin');
Route::get('/cekDataTagihan', [SettingTagihanController::class, 'cek_data_tagihan'])->middleware('admin');
Route::post('/settingTagihan', [SettingTagihanController::class, 'setting_tagihan'])->middleware('admin');
Route::get('/cariSiswa', [SettingTagihanController::class, 'cari_siswa'])->middleware('admin');

//HISTORI KELAS
Route::resource('/histori-kelas', HistoriKelasController::class)->middleware('admin');
Route::get('/getKelas/{kelas:unique}', [HistoriKelasController::class, 'get_kelas'])->middleware('admin');
Route::get('/naikKelas', [HistoriKelasController::class, 'naik_kelas'])->middleware('admin');
Route::get('/getSiswa', [HistoriKelasController::class, 'get_siswa'])->middleware('admin');
//DATATABLES
Route::get('/datatablesSiswa', [StudentController::class, 'dataTables'])->middleware('admin');
Route::get('/datatablesGuru', [TeacherController::class, 'dataTables'])->middleware('admin');
Route::get('/datatablesTahunAjaran', [TahunAjaranController::class, 'dataTables'])->middleware('admin');
Route::get('/datatablesKelas', [KelasController::class, 'dataTables'])->middleware('admin');
Route::get('/dataTablesUser', [AuthController::class, 'dataTables'])->middleware('admin');
Route::get('/dataTablesRoles', [RoleController::class, 'dataTables'])->middleware('admin');
Route::get('/dataTablesJenisPembayaran', [JenisPembayaranController::class, 'dataTables'])->middleware('admin');
Route::get('/dataTablesSettingTagihan', [SettingTagihanController::class, 'dataTables'])->middleware('admin');
Route::get('/dataTablesListTagihan', [GenerateTagihanController::class, 'dataTables_list_tagihan'])->middleware('admin');
Route::get('/dataTablesTagihanSiswaGenerate', [GenerateTagihanController::class, 'dataTables_tagihan_siswa_generate'])->middleware('admin');
Route::get('/dataTableSukarela', [TabunganController::class, 'dataTableSukarela'])->middleware('admin');
Route::get('/dataTableWajib', [TabunganController::class, 'dataTableWajib'])->middleware('admin');
Route::get('/dataTableTransport', [TabunganController::class, 'dataTableTransport'])->middleware('admin');



// TEST PDF
// Route::get('/testpdf', [LaporanPresensiController::class, 'laporan']);
// // TEST EXCEL
// Route::get('/testexcel', [ExcelController::class, 'test']);

// Route::get('/generate-pdf', [LaporanPresensiController::class, 'generatePDF']);

// Tabungan
Route::get('/inputTabungan', [TabunganController::class, 'index'])->middleware('admin');
// UNTUK MENAMBAHKAN DATA TABUNGAN 
Route::post('/tambahDataNabung', [TabunganController::class, 'tambahDataNabung'])->middleware('admin');
Route::get('/ambilSaldo', [TabunganController::class, 'ambilSaldo'])->middleware('admin');
// EDIT DATA
Route::get('/getDataTabunganWajib/{tabungan:unique}', [TabunganController::class, 'getDataTabunganWajib'])->middleware('admin');
// UPDATE DATA
Route::post('/updateDataTabunganWajib', [TabunganController::class, 'updateDataTabunganWajib'])->middleware('admin');
// DELETE TABUNGAN ALL
Route::post('/deleteTabungan/{tabungan:unique}', [TabunganController::class, 'deleteTabungan'])->middleware('admin');
Route::get('/tabunganSiswa', [TabunganController::class, 'tabunganSiswa'])->middleware('student');
