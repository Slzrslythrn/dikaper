<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('dashboard');
    });
    Route::group(['prefix' => 'log-aktivitas'], function () {
        Route::get('/', [App\Http\Controllers\MainController::class, 'log'])->name('log');
    });
    Route::middleware(['role:admin,superadmin'])->group(function () {
        Route::group(['prefix' => 'master'], function () {
            Route::group(['prefix' => 'data-user'], function () {
                Route::get('/', [App\Http\Controllers\DataUserController::class, 'index'])->name('data-user');
                Route::get('/buat', [App\Http\Controllers\DataUserController::class, 'buat'])->name('data-user.buat');
                Route::post('/simpan', [App\Http\Controllers\DataUserController::class, 'simpan'])->name('data-user.simpan');
                Route::get('/{id}/edit', [App\Http\Controllers\DataUserController::class, 'edit'])->name('data-user.edit');
                Route::put('/{user}/update', [App\Http\Controllers\DataUserController::class, 'update'])->name('data-user.update');
                Route::get('/{id}/verifikasi', [App\Http\Controllers\DataUserController::class, 'verifikasi'])->name('data-user.verifikasi');
                Route::delete('/{user}/delete', [App\Http\Controllers\DataUserController::class, 'destroy'])->name('data-user.destroy');
            });
            Route::group(['prefix' => 'rumah-sakit'], function () {
                Route::get('/', [App\Http\Controllers\DataRumahSakitController::class, 'index'])->name('data-rumahSakit');
                Route::get('/buat', [App\Http\Controllers\DataRumahSakitController::class, 'buat'])->name('data-rumahSakit.buat');
                Route::post('/simpan', [App\Http\Controllers\DataRumahSakitController::class, 'simpan'])->name('data-rumahSakit.simpan');
                Route::get('/{id}/edit', [App\Http\Controllers\DataRumahSakitController::class, 'edit'])->name('data-rumahSakit.edit');
                Route::put('/{id}/update', [App\Http\Controllers\DataRumahSakitController::class, 'update'])->name('data-rumahSakit.update');
                Route::delete('/{id}/delete', [App\Http\Controllers\DataRumahSakitController::class, 'destroy'])->name('data-rumahSakit.destroy');
            });
        });
    });

    Route::group(['prefix' => 'jamkesda'], function () {
        Route::middleware(['role:admin,superadmin,verifikator'])->group(function () {
            Route::get('/', [App\Http\Controllers\JamkesdaController::class, 'index'])->name('jamkesda');
            Route::get('/tambah', [App\Http\Controllers\JamkesdaController::class, 'tambah'])->name('jamkesda.tambah');
            Route::post('/buat', [App\Http\Controllers\JamkesdaController::class, 'buat'])->name('jamkesda.buat');
            Route::get('/selesai', [App\Http\Controllers\JamkesdaController::class, 'selesai'])->name('jamkesda.selesai');
            Route::post('/export', [App\Http\Controllers\JamkesdaController::class, 'export'])->name('jamkesda.export');
            Route::delete('/{id}/delete/jamkesda', [App\Http\Controllers\JamkesdaController::class, 'destroy'])->name('jamkesda.destroy');

            Route::group(['prefix' => 'tagihan'], function () {
                Route::post('/simpan', [App\Http\Controllers\JamkesdaController::class, 'simpanTagihan'])->name('jamkesda.tagihan.simpan');
                Route::get('/{id}/edit', [App\Http\Controllers\JamkesdaController::class, 'editTagihan'])->name('jamkesda.tagihan.edit');
                Route::post('/update', [App\Http\Controllers\JamkesdaController::class, 'updateTagihan'])->name('jamkesda.tagihan.update');
                Route::get('/{id}/hapus', [App\Http\Controllers\JamkesdaController::class, 'hapusTagihan'])->name('jamkesda.tagihan.hapus');
            });
            Route::group(['prefix' => 'pembayaran'], function () {
                Route::post('/simpan', [App\Http\Controllers\JamkesdaController::class, 'simpanPembayaran'])->name('jamkesda.pembayaran.simpan');
                Route::get('/{id}/edit', [App\Http\Controllers\JamkesdaController::class, 'editPembayaran'])->name('jamkesda.pembayaran.edit');
                Route::post('/update', [App\Http\Controllers\JamkesdaController::class, 'updatePembayaran'])->name('jamkesda.pembayaran.update');
                Route::get('/{id}/hapus', [App\Http\Controllers\JamkesdaController::class, 'hapusPembayaran'])->name('jamkesda.pembayaran.hapus');
            });
            Route::group(['prefix' => 'lihat'], function () {
                Route::get('/{id}', [App\Http\Controllers\PengajuanController::class, 'lihat'])->name('jamkesda.lihat');
                Route::get('/{id}/diagnosa/tambah', [App\Http\Controllers\PengajuanController::class, 'diagnosaTambah'])->name('jamkesda.diagnosa.tambah');
                Route::put('/{id}/diagnosa/update', [App\Http\Controllers\PengajuanController::class, 'diagnosaUpdate'])->name('jamkesda.diagnosa.update');
            });
            Route::get('/proses/{id}/diterima', [App\Http\Controllers\JamkesdaController::class, 'prosesDiterima'])->name('jamkesda.proses.diterima');
            Route::post('/proses/ditolak', [App\Http\Controllers\JamkesdaController::class, 'prosesDitolak'])->name('jamkesda.proses.ditolak');
            Route::post('/proses/dikembalikan', [App\Http\Controllers\JamkesdaController::class, 'prosesDikembalikan'])->name('jamkesda.proses.dikembalikan');
            Route::get('/download/{id}/diterima', [App\Http\Controllers\JamkesdaController::class, 'downloadDiterima'])->name('jamkesda.download.diterima');
        });

        Route::group(['prefix' => 'pengajuan'], function () {
            Route::get('/', [App\Http\Controllers\PengajuanController::class, 'index'])->name('pengajuan');
            Route::get('/buat', [App\Http\Controllers\PengajuanController::class, 'buat'])->name('pengajuan.buat');
            Route::get('/buat/{id}', [App\Http\Controllers\PengajuanController::class, 'buatById'])->name('pengajuan.buatById');

            Route::post('/tambah', [App\Http\Controllers\PengajuanController::class, 'tambahBiodata'])->name('pengajuan.tambah');
            Route::get('/pengajuan-ulang/{id}', [App\Http\Controllers\PengajuanController::class, 'getUpdate'])->name('pengajuan.getUpdate');

            Route::get('/{id}/buat/diagnosa', [App\Http\Controllers\PengajuanController::class, 'diagnosaTambah'])->name('pengajuan.diagnosa.tambah');
            Route::put('/{id}/tambah/diagnosa', [App\Http\Controllers\PengajuanController::class, 'diagnosaUpdate'])->name('pengajuan.diagnosa.update');

            Route::get('/buat/upload/{id}', [App\Http\Controllers\PengajuanController::class, 'buatUpload'])->name('pengajuan.buat.upload');
            Route::post('/tambah/upload', [App\Http\Controllers\PengajuanController::class, 'tambahUpload'])->name('pengajuan.tambah.upload');
            Route::delete('/{id}/delete', [App\Http\Controllers\PengajuanController::class, 'destroy'])->name('pengajuan.destroy');
            Route::get('/{id}/ajukan', [App\Http\Controllers\PengajuanController::class, 'ajukan'])->name('pengajuan.ajukan');
            Route::get('/{id}/lihat', [App\Http\Controllers\PengajuanController::class, 'lihat'])->name('pengajuan.lihat');
            Route::get('/{id}/download', [App\Http\Controllers\PengajuanController::class, 'download'])->name('pengajuan.download');
        });

        Route::middleware(['role:admin,superadmin'])->group(function () {
            Route::group(['prefix' => 'pasien'], function () {
                Route::get('/', [App\Http\Controllers\PasienController::class, 'index'])->name('pasien');
                Route::get('/pasien/{pasien_id}', [App\Http\Controllers\PasienController::class, 'show'])->name('pasien.show');
            });
        });
    });

    Route::middleware(['role:admin,superadmin'])->group(function () {
        Route::group(['prefix' => 'baznas'], function () {
            Route::get('/', [App\Http\Controllers\BaznasController::class, 'index'])->name('baznas');
            Route::get('/buat', [App\Http\Controllers\BaznasController::class, 'buat'])->name('baznas.buat');
            Route::post('/simpan', [App\Http\Controllers\BaznasController::class, 'simpan'])->name('baznas.simpan');
            Route::get('/{id}/edit', [App\Http\Controllers\BaznasController::class, 'edit'])->name('baznas.edit');
            Route::put('/{id}/update', [App\Http\Controllers\BaznasController::class, 'update'])->name('baznas.update');
            Route::delete('/{id}/delete', [App\Http\Controllers\BaznasController::class, 'destroy'])->name('baznas.destroy');
            Route::get('/{id}/cetak', [App\Http\Controllers\BaznasController::class, 'cetak'])->name('baznas.cetak');
        });
    });
});

require __DIR__ . '/auth.php';
 // Route::get('/buat/diagnosa', [App\Http\Controllers\PengajuanController::class, 'buatDiagnosa'])->name('pengajuan.buat.diagnosa');
            // Route::post('/tambah/diagnosa', [App\Http\Controllers\PengajuanController::class, 'tambahDiagnosa'])->name('pengajuan.tambah.diagnosa');
