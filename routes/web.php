<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DataAnggotaController;
use App\Http\Controllers\DataBarangMasukController;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\DataKategoriController;
use App\Http\Controllers\WorkshopController;

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NoAksesController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PengembalianController1;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PerbaikanController;
use App\Models\Perbaikan;
use App\Http\Controllers\DataMesinController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\MesinImportEksportController;
use App\Http\Controllers\PopupDataMesinController;
use App\Models\KlasMesin;
use App\Http\Controllers\NoRegistrasiController;
use App\Models\KategoriMesin;
use App\Models\NoRegistrasi;
use App\Http\Controllers\KategoriMesinController;
use App\Http\Controllers\KlasMesinController;

use App\Http\Controllers\SearchController;
use App\Models\DataMesin;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;
use App\Http\Controllers\DropDownController;
use App\Http\Controllers\LandingPublicController;
use App\Http\Controllers\LaporanPerbaikanController;
use App\Http\Controllers\PermintaanController;
use App\Models\Workshop;





use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ValidasiController;
use App\Imports\DepartemenImport;
use App\Exports\DepartemenExport;
use App\Exports\PlantExport;
use App\Http\Controllers\Akun\EditAkunController;
use App\Http\Controllers\Analisis\AnalisisController;
use App\Http\Controllers\CekPelaporanController;
use App\Http\Controllers\Feedback\FeedbackController;
use App\Http\Controllers\HistoryPelaporanController;
use App\Http\Controllers\PelaporanMasukController;
use App\Http\Controllers\PelaporanSelesaiController;
use App\Http\Controllers\TambahPelaporanController;
use App\Imports\PlantImport;
use App\Models\Departemen;
use App\Models\Pelaporan;
use App\Models\Plant;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/profile/{user}', [EditAkunController::class, 'showProfile'])->name('akun.index');
Route::get('/profile/{user}/edit', [EditAkunController::class, 'editProfile'])->name('akun.edit');
Route::post('/profile/{user}/update', [EditAkunController::class, 'updateProfile'])->name('akun.update');


Route::post('/cetak-laporan', [PelaporanSelesaiController::class, 'cetakLaporanBerdasarkanTanggal'])->name('cetak-laporan');
/*Data Export */

Route::post('api/getklasmesin', [DataMesinController::class, 'getklasmesin']);

Route::resource('/data-mesin', DropDownController::class);
Route::get('/getKlasifikasi', [DropDownController::class, 'getKlasifikasi']);
Route::get('/data-mesin/{id}/edit', 'DataMesinController@edit');
Route::post('/data-mesin-update/{id}', [DataMesinController::class, 'update']);

Route::get('/get-latest-id', [DataMesinController::class, 'getLatestID']);
Route::get('/get-latest-mesin/{kategoriID}/{klasifikasiID}/{tahun}', [DataMesinController::class, 'getLatestmESIN']);
Route::get('/get-latest-mesin-by-id/{kategoriID}/{klasifikasiID}/{id}', [DataMesinController::class, 'getLatestbyId']);
Route::get('/get-latest-id/{kategoriID}/{klasifikasiID}', [DataMesinController::class, 'getLatestID']);
Route::get('/get-kategori-data', [DataMesinController::class, 'getKategoriData']);
Route::get('/get-klasifikasi-data/{kategori}', [DataMesinController::class, 'getKlasifikasiData']);


Route::get('/search', [SearchController::class, 'search']);
Route::get('/search', [SearchController::class, 'search'])->name('search');


Route::get('file-import-export', [MesinImportEksportController::class, 'ImportExport']);
Route::post('file-import', [MesinImportEksportController::class, 'DataMesinImport'])->name('file-import');
Route::get('file-export', [MesinImportEksportController::class, 'DataMesinExport'])->name('file-export');


/*DATA MESIN */

Route::resource('/data-mesin', DataMesinController::class)->middleware('auth', 'isAdmin');
/*RESET DATA MESIN*/
Route::post('/reset-datamesin', [DatamesinController::class, 'reset'])->name('reset.datamesin');

/*WORKSHOP*/
Route::resource('/lokasi-workshop-mesin', WorkshopController::class);
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/lokasi-workshop-mesin', WorkshopController::class)
        ->only(['edit', 'destroy']);
});
/*EXPORT DAN IMPORT*/
Route::get('/workshop-export-excel', [WorkshopController::class, 'export'])->name('export');
Route::post('workshop-import-excel', [WorkshopController::class, 'import'])->name('import');
/*RESET DATA*/
Route::post('/workshop/reset', [PlantController::class, 'reset'])->name('plant.reset');

/*KLASIFIKASI*/
Route::resource('/klasifikasi-mesin', KlasMesinController::class)->middleware('auth', 'isAdmin');
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/klasifikasi-mesin', KlasMesinController::class)
        ->only(['edit', 'destroy']);
});
/*EXPORT DAN IMPORT*/
Route::get('/klasifikasi-export-excel', [KlasMesinController::class, 'export'])->name('export');
Route::post('klasifikasi-import-excel', [KlasMesinController::class, 'import'])->name('import');
/*RESET DATA*/
Route::post('/klasifikasi/reset', [PlantController::class, 'reset'])->name('plant.reset');

Route::resource('/registrasi-mesin', NoRegistrasiController::class);

/*KATEGORI*/
Route::resource('/kategori-mesin', KategoriMesinController::class);
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/kategori-mesin', KategoriMesinController::class)
        ->only(['edit', 'destroy']);
});
/*EXPORT DAN IMPORT*/
Route::get('/kategori-export-excel', [KategoriMesinController::class, 'export'])->name('export');
Route::post('kategori-import-excel', [KategoriMesinController::class, 'import'])->name('import');
/*RESET DATA*/
Route::post('/klasifikasi/reset', [KategoriMesinController::class, 'reset'])->name('kategori.reset');



/*DEPARTEMEN*/
Route::resource('/departemen', DepartemenController::class)->middleware('isAdmin');
/*EXPORT DAN IMPORT*/
Route::get('/departemen-export-excel', [DepartemenController::class, 'export'])->name('export');
Route::post('departemen-import-excel', [DepartemenController::class, 'import'])->name('import');
/*RESET DATA*/
Route::post('/departemen/reset', [DepartemenController::class, 'reset'])->name('departemen.reset');

/*PLANT*/
Route::resource('plant', PlantController::class)->middleware('isAdmin');
/*EXPORT DAN IMPORT*/
Route::get('/plant-export-excel', [PlantController::class, 'export'])->name('export');
Route::post('plant-import-excel', [PlantController::class, 'import'])->name('import');
/*RESET DATA*/
Route::post('/plant/reset', [PlantController::class, 'reset'])->name('plant.reset');

/*TIDAK BISA DIAKSES*/
Route::get('/tidak-memiki-izin', [NoAksesController::class, 'index']);

/*DATA PUBLIC*/
Route::get('/qrcode/{kode_jenis}', [QRCodeController::class, 'showQRCode'])->name('qrcode.show');
Route::get('/qrcode/hasil/{kode_jenis}', [QRCodeController::class, 'showResult'])->name('qrcode.result');
Route::resource('/spesifikasi-mesin', PerbaikanController::class);

/*qrcode*/
Route::get('/generate-qr-code/{code}', [QRCodeController::class, 'generateQRCode'])->name('qrcode.generate');

/*PENGAJUAN*/
Route::resource('/pengajuan1', PermintaanController::class)->middleware('auth');
Route::get('/buat-pengajuan/{id}', [PermintaanController::class, 'create'])->middleware('auth');
Route::resource('analisis', AnalisisController::class);
Route::resource('feedback', FeedbackController::class);

Route::resource('/validasi', ValidasiController::class)->middleware(['auth', 'isAdmin']);

/*LAPORAN*/
Route::resource('/laporan-perbaikan', LaporanPerbaikanController::class)->middleware('auth');

Route::get('/status', [StatusController::class, 'index']);
Route::get('/perbaikan', [PerbaikanController::class, 'index']);
Route::resource('/perbaikan', PerbaikanController::class);

/*LANDING*/
Route::resource('/landing', LandingPublicController::class);
Route::get('/qr-scan', [LandingPublicController::class, 'showQrCodeScanner']);

Route::middleware(['auth'])->group(function () {
    Route::get('/po', [LandingPublicController::class, 'datamesin'])->name('datamesin');
});


/*DASHBOAD*/
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/pegawai/pdf', [DataAnggotaController::class, 'cetak_pdf'])->middleware(['auth', 'isAdmin']);
Route::resource('/pegawai', DataAnggotaController::class)->middleware('auth', 'isAdmin');

Route::get('users/data', 'UserController@getData')->name('users.data');

/*server side*/
Route::get('/mesin', [DataMesinController::class, 'index'])->name('mesin.index');
Route::get('/mesin/data', [DataMesinController::class, 'getDataMesin'])->name('mesin.data');


Route::resource('/datapetugas', UserController::class)->middleware(['auth', 'isAdmin']);
Route::get('/petugas/pdf', [UserController::class, 'cetak_pdf']);
Route::resource('/datamesin', DataBukuController::class);
Route::get('/mesin/printpdf', [DataBukuController::class, 'cetak_pdf']);
Route::get('/mesin/printqrcodepdf', [DataBukuController::class, 'cetakQRCodePDF'])->name('mesin.printqrcodepdf');
Route::resource('/datakategori', DataKategoriController::class);
Route::get('/kategori/printpdf', [DataKategoriController::class, 'cetak_pdf']);
Route::resource('/pinjam', PeminjamanController::class);
Route::get('/datapinjam/printpdf', [PeminjamanController::class, 'cetak_pdf']);
Route::get('/transaksipengembalian/{id}', [TransaksiController::class, 'pengembalian']);
Route::resource('/pengembalian', PengembalianController::class);
Route::get('/datapengembalian/printpdf', [PengembalianController::class, 'cetak_pdf']);
Route::resource('/laporan', LaporanController::class);


/*DATA BARANG */
Route::resource('/data-masuk', DataBarangMasukController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*USER*/
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::put('/users/approve/{user}', [UserController::class, 'approve'])->name('users.approve');
Route::put('/users/unapprove/{user}', [UserController::class, 'unapprove'])->name('users.unapprove');
/*EXPORT DAN IMPORT*/
Route::get('/user-export-excel', [UserController::class, 'export'])->name('export');
Route::post('user-import-excel', [UserController::class, 'import'])->name('import');
/*RESET DATA*/
Route::post('/user/reset', [UserController::class, 'reset'])->name('user.reset');

Route::group(['middleware' => ['auth', 'checkApproved']], function () {
    // Rute yang memerlukan persetujuan
    Route::resource('pengajuan', PengajuanController::class);
    // Tambahkan rute lain yang memerlukan persetujuan di sini
});

Route::prefix('pelaporan')->group(function () {
    Route::group(['middleware' => ['auth', 'isAdmin']], function () {
        Route::resource('/masuk', PelaporanMasukController::class);
        Route::get('/masuk/detail/{id}', [PelaporanMasukController::class, 'detail']);
        Route::put('/masuk/detail/{pelaporan:id}/perbaiki', [PelaporanMasukController::class, 'perbaiki']);
        Route::put('/masuk/detail/{pelaporan:id}/selesai', [PelaporanMasukController::class, 'selesai']);
        Route::get('/analisis/create/{id}', [AnalisisController::class, 'create']);
        Route::post('/analisis/store', [AnalisisController::class, 'store']);
    });

    Route::group(['middleware' => ['auth', 'checkApproved', 'isKaryawan']], function () {
        Route::resource('/tambah', TambahPelaporanController::class);
        Route::get('/get-data-mesin', [TambahPelaporanController::class, 'getDataMesin']);
        Route::post('/tambah/store', [TambahPelaporanController::class, 'store']);
        Route::resource('/cek', CekPelaporanController::class);
        Route::get('/cek/laporan/{id}', [CekPelaporanController::class, 'cekPelaporan']);
        Route::get('/cek/detail/{id}', [CekPelaporanController::class, 'detail']);
        Route::post('/cek/detail/{id}', [CekPelaporanController::class, 'store']);
        Route::get('/get-spek-mesin', [TambahPelaporanController::class, 'getSpekMesin']);
        Route::post('/history/{id}', [HistoryPelaporanController::class, 'index']);
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('/selesai', PelaporanSelesaiController::class);
        Route::get('/selesai/cetak/{id}', [PelaporanSelesaiController::class, 'cetakLaporan']);
        Route::get('/feedback/create/{id}', [FeedbackController::class, 'create']);
        Route::post('/feedback/store', [FeedbackController::class, 'store']);
    });
});

Route::get('/selesai/laporan/pdf', [PelaporanSelesaiController::class, 'cetak_pdf']);
Route::post('/cetak-laporan', [PelaporanSelesaiController::class, 'cetakLaporanBerdasarkanTanggal'])->name('cetak-laporan');
