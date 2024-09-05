<?php

namespace App\Http\Controllers;

use App\Exports\JamkesdaSelesai;
use App\Helpers\Log;
use App\Models\Inacbgs;
use App\Models\Kelurahan;
use App\Models\Pasien;
use App\Models\Pembayaran;
use App\Models\PembayaranInacbgs;
use App\Models\Persyaratan;
use App\Models\RumahSakit;
use App\Models\SetSktm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use File;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JamkesdaController extends Controller
{
    public function index(Request $request)
    {
        $tahun = Session::get('tahun'); // Mengambil tahun dari session, default ke tahun sekarang

        $pasienCollection = Pasien::with('rumahsakit')
            ->where('status', '!=', 'Diterima')
            ->whereYear('tgl_diterima', $tahun)
            ->orderByDesc('pasien_id')
            ->get();

        $pasienCollection->each(function ($pasien) {
            if (!$pasien->rumahsakit) {
                $rumahsakit = DB::select(
                    'SELECT * FROM rumahsakit rs WHERE rs.kode = :kode_rs LIMIT 1',
                    ['kode_rs' => $pasien->kode_rs]
                );

                $rumahsakit = $rumahsakit ? $rumahsakit[0] : null;

                // Tambahkan hasil query sebagai atribut rumahsakit ke objek pasien
                $pasien->rumahsakit = $rumahsakit;
            }
        });

        // $pasien = Pasien::whereYear('tgl_diterima', $tahun)->get();
        return view('pages.admin.jamkesda.page', ['pasien' => $pasienCollection]);
    }

    public function tambah()
    {
        $kelurahan = Kelurahan::with('kecamatan')->get();
        $rumas = DB::table('rumahsakit')->get();

        $puskesmas = array(
            'Puskesmas Cipaku' => 'Puskesmas Cipaku',
            'Puskesmas Gang Aut' => 'Puskesmas Gang Aut',
            'Puskesmas Bogor Selatan' => 'Puskesmas Bogor Selatan',
            'Puskesmas Tanah Sereal' => 'Puskesmas Tanah Sereal',
            'Puskesmas Pondok Rumput' => 'Puskesmas Pondok Rumput',
            'Puskesmas Bondongan' => 'Puskesmas Bondongan',
            'Puskesmas Lawang Gintung' => 'Puskesmas Lawang Gintung',
            'Puskesmas Kedung Badak' => 'Puskesmas Kedung Badak',
            'Puskesmas Mekarwangi' => 'Puskesmas Mekarwangi',
            'Puskesmas Kayu Manis' => 'Puskesmas Kayu Manis',
            'Puskesmas Warung Jambu' => 'Puskesmas Warung Jambu',
            'Puskesmas Bogor Utara' => 'Puskesmas Bogor Utara',
            'Puskesmas Tegal Gundil' => 'Puskesmas Tegal Gundil',
            'Puskesmas Pulo Armyn' => 'Puskesmas Pulo Armyn',
            'Puskesmas Bogor Timur' => 'Puskesmas Bogor Timur',
            'Puskesmas Bogor Tengah' => 'Puskesmas Bogor Tengah',
            'Puskesmas Sempur' => 'Puskesmas Sempur',
            'Puskesmas Merdeka' => 'Puskesmas Merdeka',
            'Puskesmas Pancasan' => 'Puskesmas Pancasan',
            'Puskesmas Gang Kelor' => 'Puskesmas Gang Kelor',
            'Puskesmas Semplak' => 'Puskesmas Semplak',
            'Puskesmas Sindang Barang' => 'Puskesmas Sindang Barang',
            'Puskesmas Pasir Mulya' => 'Puskesmas Pasir Mulya',
            'Puskesmas Belong' => 'Puskesmas Belong',
            'Puskesmas Mulyaharja' => 'Puskesmas Mulyaharja',
            'Labkesda' => 'Labkesda',
            'IGD' => 'IGD',
        );

        $pasien = (object) [
            'no_ktp' => null,
            'no_kk' => null,
            'no_sjp' => null,
            'nama_kepala' => null,
            'nama_pasien' => null,
            'jenis_kelamin' => null,
            'tempat_lahir' => null,
            'tanggal_lahir' => now(),
            'kelurahan_id' => null,
            'alamat' => null,
            'hubungan_kk' => null,
            'ket_jamkesda' => null,
            'status' => null,
            // 'keterangan_status' => null, 
            // 'status' => '',
            'no_sktm' => null,
            'nama_pkm' => null,
            'no_rujuk_igd' => null,
            'diagnosa' => null,
            'kode_rs' => null,
            'tgl_mulairawat' => null,
            'dikelas' => null,
            'dijamin_sejak' => now(),
            'tgl_diterima' => null,
            'jenis_rawat' => null,
            'status_kepersertaan' => null,
            'tgl_aktif_va' => null

        ];

        return view('pages.admin.jamkesda.buat', compact('kelurahan', 'rumas', 'puskesmas', 'pasien'));
    }

    public function buat(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|max:16|min:16',
            'no_kk' => 'required|max:16|min:16',
            // 'no_sjp' => 'required',
            'nama_kepala' => 'required',
            'nama_pasien' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelurahan_id' => 'required',
            'alamat' => 'required',
            'hubungan_kk' => 'required',
            'ket_jamkesda' => 'required',

            'nama_pkm' => 'required',
            'no_rujuk_igd' => 'required',
            'diagnosa' => 'required',
            'kode_rs' => 'required',
            'tgl_mulairawat' => 'required',
            'jenis_rawat' => 'required',
            'dikelas' => 'required',
            'dijamin_sejak' => 'required',
            // 'tgl_aktif_va' => 'required',
            'status_kepersertaan' => 'required',

            'ktp_kk' =>  ['required', 'mimes:pdf', 'max:2000'],
            'sktm' =>  ['required', 'mimes:pdf', 'max:2000'],
            'doc' =>  ['required', 'mimes:pdf', 'max:2000'],
            // 'ktp_kk' => 'required',
            // 'va' => 'required',

        ], [
            'no_ktp.required' => 'Form input harap diisi',
            'no_kk.required' => 'Form input harap diisi',
            // 'no_sjp.required' => 'Form input harap diisi',
            'nama_kepala.required' => 'Form input harap diisi',
            'nama_pasien.required' => 'Form input harap diisi',
            'jenis_kelamin.required' => 'Form input harap diisi',
            'tempat_lahir.required' => 'Form input harap diisi',
            'tanggal_lahir.required' => 'Form input harap diisi',
            'kelurahan_id.required' => 'Form input harap diisi',
            'alamat.required' => 'Form input harap diisi',
            'hubungan_kk.required' => 'Form input harap diisi',
            'ket_jamkesda.required' => 'Form input harap diisi',

            'nama_pkm.required' => 'Form input harap diisi',
            'no_rujuk_igd.required' => 'Form input harap diisi',
            'diagnosa.required' => 'Form input harap diisi',
            'kode_rs.required' => 'Form input harap diisi',
            'tgl_mulairawat.required' => 'Form input harap diisi',
            'jenis_rawat.required' => 'Form input harap diisi',
            'dikelas.required' => 'Form input harap diisi',
            'dijamin_sejak.required' => 'Form input harap diisi',
            // 'tgl_aktif_va.required' => 'Form input harap diisi',
            'status_kepersertaan.required' => 'Form input harap diisi',

            'ktp_kk.required' => 'Form input KTP/KK harap diisi',
            'ktp_kk.mimes' => 'File KTP/KK harus berupa PDF',
            'ktp_kk.max' => 'Ukuran file KTP/KK tidak boleh lebih dari 2MB',

            'sktm.required' => 'Form input SKTM harap diisi',
            'sktm.mimes' => 'File SKTM harus berupa PDF',
            'sktm.max' => 'Ukuran file SKTM tidak boleh lebih dari 2MB',

            'doc.required' => 'Form input DOC harap diisi',
            'doc.mimes' => 'File DOC harus berupa PDF',
            'doc.max' => 'Ukuran file DOC tidak boleh lebih dari 2MB',

        ]);

        // create a pasien id
        $getPasienId = Pasien::orderBy('pasien_id', 'DESC')->first();
        if (empty($getPasienId)) {
            $pasien_id = '1';
        } else {
            $urut = $getPasienId->pasien_id + 1;
            $pasien_id = $urut;
        }

        $attr = [
            'pasien_id' => $pasien_id,
            'users_id' => auth()->user()->id,
            'no_peserta' => '410/' . $pasien_id . '/SKTM/' . date('Y'),
            'no_ktp' => $request->no_ktp,
            'no_kk' => $request->no_kk,
            // 'no_sjp' => $request->no_sjp,
            'nama_kepala' => $request->nama_kepala,
            'nama_pasien' => $request->nama_pasien,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelurahan_id' => $request->kelurahan_id,
            'alamat' => $request->alamat,
            'hubungan_kk' => $request->hubungan_kk,
            'ket_jamkesda' => $request->ket_jamkesda,
            'status' => 'Diproses',
            // 'keterangan_status' => '',
            // 'no_sktm' => $newNoSktm,
            'nama_pkm' => $request->nama_pkm,
            'no_rujuk_igd' => $request->no_rujuk_igd,
            'diagnosa' => $request->diagnosa,
            'kode_rs' => $request->kode_rs,
            'tgl_mulairawat' => $request->tgl_mulairawat,
            'jenis_rawat' => $request->jenis_rawat,
            'dikelas' => $request->dikelas,
            'dijamin_sejak' => $request->dijamin_sejak,
            // 'tgl_aktif_va' => $request->tgl_aktif_va,
            'status_kepersertaan' => $request->status_kepersertaan,
            'tgl_diterima' => now(),

        ];
        $store = Pasien::create($attr);

        $data = Persyaratan::where('pasien_id', $pasien_id)->first();

        $attr2 = [];

        // if ($request->hasFile('ktp_kk')) {
        //     $files = $request->file('ktp_kk');

        //     foreach ($files as $index => $file) {
        //         $ext = $file->getClientOriginalExtension();
        //         $fileName = date('dmY') . Str::random(3);

        //         if ($index == 0) {
        //             $newName = $fileName . 'KK' . '.' . $ext;
        //             $file->move('uploads/ktpKk', $newName);
        //             $attr2['ktp_kk'] = $newName; // Adjust path and file name for KTP
        //         } elseif ($index == 1) {
        //             $newName = $fileName . 'BPB' . '.' . $ext;
        //             $file->move('uploads/buktiPendaftaranBpjs', $newName);
        //             $attr2['va'] = $newName; // Adjust path and file name for KK
        //         }
        //     }
        // }

        // if ($request->hasFile('doc')) {
        //     $file = $request->file('doc')[0];
        //     $ext = $file->getClientOriginalExtension();
        //     $newName =  date('dmY') . Str::random(3) . 'DOC' .  '.' . $ext;
        //     $file->move('uploads/doc', $newName);
        //     $attr2['doc'] = $newName;
        // }

        // Handle file upload dan hapus file lama jika ada file baru diunggah
        $fileFields = [
            'va' => 'uploads/buktiPendaftaranBpjs',
            'surat_pernyataan' => 'uploads/suratPernyataan',
            'rekomendasi' => 'uploads/rekomendasi',
            'rujukan_pkm' => 'uploads/rujukanPkm',
            'rawat_inap' => 'uploads/rawatInap',
            'sktm' => 'uploads/sktm',
            'ktp_kk' => 'uploads/ktpKk',
            'catatan' => 'uploads/catatan',
            'doc' => 'uploads/doc'
        ];

        foreach ($fileFields as $field => $path) {
            if ($request->hasFile($field)) {



                // Hapus file lama jika ada
                if ($data && $data->$field) {

                    $oldFile = public_path($path . '/' . $data->$field);
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                // Upload file baru
                $file = $request->file($field);
                $ext = $file->getClientOriginalExtension();
                $newName = date('dmY') . Str::random(3) . strtoupper($field[0]) . '.' . $ext;
                $file->move($path, $newName);
                $attr2[$field] = $newName;
            }
        }

        $attr2['pasien_id'] = $pasien_id;

        // $pasien = Pasien::where('pasien_id', $request->pasien_id)->first();
        // $pasien->update(['status' => 'Draft', 'keterangan_status' => '']);

        if ($data) {
            // Update data jika sudah ada

            $data->update($attr2);
        } else {
            // Simpan data baru jika belum ada
            Persyaratan::create($attr2);
        }

        // Log::logSave('Upload File Kelengkapan Pengajuan');

        // Alert::success('Pengajuan Telah Selesai Dibuat');
        // $attr2['pasien_id'] = $pasien_id;
        // // dd($attr2);
        // $store2 = Persyaratan::create($attr2);

        Log::logSave('Menambah data pasien manual ' . $request->nama_pasien);

        Alert::success('Pengajuan Diterima');
        return redirect()->route('jamkesda');
    }

    public function destroy($pasien_id)
    {
        $pasien = Pasien::findOrFail($pasien_id);

        if ($pasien->va) {
            File::delete('uploads/buktiPendaftaranBpjs/' . $pasien->va);
            // unlink(public_path('uploads/uttp/' . $item->gambar));
        }
        if ($pasien->surat_pernyataan) {
            File::delete('uploads/suratPernyataan/' . $pasien->surat_pernyataan);
            // unlink(public_path('uploads/uttp/' . $item->gambar));
        }
        if ($pasien->rekomendasi) {
            File::delete('uploads/rekomendasi/' . $pasien->rekomendasi);
            // unlink(public_path('uploads/uttp/' . $item->gambar));
        }
        if ($pasien->rujukan_pkm) {
            File::delete('uploads/rujukanPkm/' . $pasien->rujukan_pkm);
            // unlink(public_path('uploads/uttp/' . $item->gambar));
        }
        if ($pasien->rawat_inap) {
            File::delete('uploads/rawatInap/' . $pasien->rawat_inap);
            // unlink(public_path('uploads/uttp/' . $item->gambar));
        }
        if ($pasien->sktm) {
            File::delete('uploads/sktm/' . $pasien->sktm);
            // unlink(public_path('uploads/uttp/' . $item->gambar));
        }
        if ($pasien->ktp_kk) {
            File::delete('uploads/ktpKk/' . $pasien->ktp_kk);
            // unlink(public_path('uploads/uttp/' . $item->gambar));
        }
        if ($pasien->catatan) {
            File::delete('uploads/catatan/' . $pasien->catatan);
            // unlink(public_path('uploads/uttp/' . $item->gambar));
        }

        $persyaratanDelete = Persyaratan::where('pasien_id', $pasien->pasien_id)->first()->delete();
        $pasien->delete();

        Log::logSave('Hapus Data Pengajuan Pasien');

        Alert::success('Data Berhasil Dihapus');
        return redirect()->route('jamkesda.selesai');
    }

    public function selesai()
    {
        Carbon::setLocale('id');

        $pasienCollection = Pasien::with('rumahsakit', 'pembayaran')
            ->where('status', 'Diterima')->orWhere('status', 'Ditolak')
            ->orderBy('tgl_diterima', 'DESC')
            ->get();

        $pasienCollection->each(function ($pasien) {
            if (!$pasien->rumahsakit) {
                $rumahsakit = DB::select(
                    'SELECT * FROM rumahsakit rs WHERE rs.kode = :kode_rs LIMIT 1',
                    ['kode_rs' => $pasien->kode_rs]
                );

                $rumahsakit = $rumahsakit ? $rumahsakit[0] : null;

                // Tambahkan hasil query sebagai atribut rumahsakit ke objek pasien
                $pasien->rumahsakit = $rumahsakit;
            }
        });

        // $inacbgs = Inacbgs::all();
        $rumahsakit = RumahSakit::all();
        // dd($inacbgs);
        // compact('pasien', 'inacbgs', 'rumahsakit')
        return view('pages.admin.jamkesda.selesai', [
            'pasien' => $pasienCollection,

            'rumahsakit' => $rumahsakit,
        ]);
    }

    public function getDiagnosaByJenisRs(Request $request)
    {
        $diagnosa = Inacbgs::where('jenis_rs', $request->jenis_rs)->get();
        return response()->json($diagnosa);
    }

    public function getTarifByDiagnosa(Request $request)
    {
        $tarif = Inacbgs::where('id', $request->id)->first();
        return response()->json($tarif);
    }

    public function export(Request $request)
    {
        $nama_file = 'laporan_sembako_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new JamkesdaSelesai($request->all()), $nama_file);
    }

    public function prosesDiterima($pasien_id)
    {
        $pasien = Pasien::findOrFail($pasien_id);
        $count = Pasien::count();

        $getNoSktm = Pasien::orderBy('no_sktm', 'DESC')->first();

        // dd($getNoSktm);
        if ($getNoSktm->no_sktm == 0) {

            $nomorSktm = SetSktm::first();

            if ($nomorSktm) {
                $noSktm = $nomorSktm->no_sktm;
            } else {
                Alert::error('Harap input terlebih dahulu nomor SKTM.');
                return redirect()->back(); // Menghentikan eksekusi dan mengembalikan user
            }
        } else {
            $noSktm =  $getNoSktm->no_sktm + 1;
        }

        // if (is_null($getNoSktm->no_sktm)) {
        //     $noSktm = SetSktm::first(); // Mengambil item pertama tanpa menggunakan all()

        //     if (empty($noSktm)) {
        //         Alert::error('Harap input terlebih dahulu nomor SKTM.');
        //         return redirect()->back(); // Menghentikan eksekusi dan mengembalikan user
        //     }

        //     $noSktm = $noSktm->no_sktm; // Menggunakan nomor SKTM yang ada
        // } else {
        //     $noSktm =  (int) $getNoSktm->no_sktm + 1; // Menambahkan 1 ke nomor SKTM terakhir
        // }

        $attr['status'] = 'Diterima';
        $attr['tgl_diterima'] = date('Y-m-d');
        $attr['no_peserta'] = '410/' . $count . '/SKTM/' . date('Y');
        $attr['no_sktm'] = $noSktm;

        $update = $pasien->update($attr);

        Log::logSave('Update Status Diterima Pengajuan Pasien');

        Alert::success('Pengajuang Diterima');
        return redirect()->route('jamkesda');
    }

    public function prosesDitolak(Request $request)
    {
        $pasien_id = $request->pasien_id;
        $pasien =  Pasien::findOrFail($pasien_id);

        $attr['keterangan_status'] = $request->keterangan_status;
        $attr['status'] = 'Ditolak';

        $update = $pasien->update($attr);

        Log::logSave('Update Status Ditolak Pengajuan Pasien');

        Alert::error('Pengajuang Ditolak');
        return redirect()->route('jamkesda');
    }

    public function prosesDiKembalikan(Request $request)
    {
        $pasien_id = $request->pasien_id;
        $pasien =  Pasien::findOrFail($pasien_id);

        $attr['keterangan_status'] = $request->keterangan_status;
        $attr['status'] = 'Dikembalikan';

        $update = $pasien->update($attr);

        Log::logSave('Update Status Pengembalian Pengajuan Pasien');

        Alert::info('Pengajuang Dikembalikan');
        return redirect()->route('jamkesda');
    }

    public function downloadDiterima($pasien_id)
    {
        Carbon::setLocale('id');
        $pasien = Pasien::findOrFail($pasien_id);
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(route('jamkesda.download.diterima', ['id' => $pasien_id])));
        $logoKotaBogor = base64_encode(file_get_contents(public_path('assets/logokotabogor.gif')));
        $logoDikaper = base64_encode(file_get_contents(public_path('assets/dikaper.jpeg')));
        $lineImage = base64_encode(file_get_contents(public_path('assets/line.png')));
        $ttdImage = base64_encode(file_get_contents(public_path('assets/ttd.jpg')));
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'pasien' => $pasien,
            'qrcode' => $qrcode,
            'logoKotaBogor' => $logoKotaBogor,
            'logoDikaper' => $logoDikaper,
            'lineImage' => $lineImage,
            'ttdImage' => $ttdImage
        ];
        // dd($data);
        // $qrcode = base64_encode(\QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));

        $pdf = PDF::loadView('pages.admin.pdf-diterima', $data);

        return $pdf->stream('jamkesda-diterima.pdf');
    }

    public function pembayaran($pasien_id)
    {
        $pasien = Pasien::findOrFail($pasien_id);

        $inacbgs = Inacbgs::groupBy('jenis_rs')->get();

        return view('pages.admin.pembayaran.buat-pembayaran', compact('pasien', 'inacbgs'));
    }

    public function simpanTagihan(Request $request)
    {

        $validate = $request->validate([
            'no_rm' => ['required'],
            'tgl_keluar' => ['required'],
            'los' => ['required'],
            'jenis_rs' => ['required'],
            'diagnosa' => ['required'],
            'tarif_inacbgs' => ['required'],
            'tarif_rs' => ['required'],
            'biaya_lainnya' => ['required'],
            'total_biaya' => ['required'],
            'pasien_pulang' => ['required', 'mimes:pdf', 'max:2000']
        ], [
            'no_rm.required' => 'Form input harap diisi',
            'tgl_keluar.required' => 'Form input harap diisi',
            'los.required' => 'Form input harap diisi',
            'jenis_rs.required' => 'Form input harap diisi',
            'diagnosa.required' => 'Form input harap diisi',
            'tarif_inacbgs.required' => 'Form input harap diisi',
            'tarif_rs.required' => 'Form input harap diisi',
            'biaya_lainnya.required' => 'Form input harap diisi',
            'total_biaya.required' => 'Form input harap diisi',
            'pasien_pulang.required' => 'Form input Berkas Pasien Pulang harap diisi',
            'pasien_pulang.mimes' => 'File berkas pasien pulang harus berupa PDF',
            'pasien_pulang.max' => 'Ukuran file berkas pasien pulang tidak boleh lebih dari 2MB',
        ]);

        $pasien_id = $request->pasien_id;
        $attr = [
            'pasien_id' => $request->pasien_id,
            'no_rm' => $request->no_rm,
            'tgl_keluar' => $request->tgl_keluar,
            'los' => $request->los,
            'jenis_rs' => $request->jenis_rs,
            'diagnosa' => $request->diagnosa,
            'tarif_inacbgs' => $request->tarif_inacbgs,
            'tarif_rs' => $request->tarif_rs,
            'biaya_lainnya' => $request->biaya_lainnya,
            'total_biaya' => $request->total_biaya,
            'keterangan' => '0',
        ];

        $pembayaran = Pembayaran::where('pasien_id', $pasien_id);
        if ($pembayaran->exists()) {
            $pembayaran->first()->update($attr);
            Log::logSave('Update data tagihan dengan pasien id=' . $pasien_id);
        } else {
            Pembayaran::create($attr);
            Log::logSave('Menambahkan data tagihan dengan pasien id=' . $pasien_id);
        }

        if (isset($request->pasien_pulang)) {
            $data = Persyaratan::where('pasien_id', $pasien_id)->first();

            if ($data && $data->pasien_pulang) {
                $oldFile = public_path('uploads/pasien_pulang/' . $data->pasien_pulang);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $file = $request->file('pasien_pulang');
            $ext = $file->getClientOriginalExtension();
            $newName = date('dmY') . Str::random(3) . strtoupper($file->getClientOriginalName()[0]) . '.' . $ext;
            $file->move(public_path('uploads/pasien_pulang'), $newName);
            $inputFile['pasien_pulang'] = $newName;

            $data->update($inputFile);
            Log::logSave('Update data berkas pasien pulang dengan pasien id=' . $pasien_id);
        }

        $attr2 = [
            'pasien_id' => $request->pasien_id,
            'inacbgs_id' => $request->diagnosa,
            'total' => $request->tarif_inacbgs,
        ];

        PembayaranInacbgs::create($attr2);
        Log::logSave('Menambahkan pembayaran Inacbgs dengan pasien id=' . $pasien_id);

        Alert::success('Data Berhasil Ditambahkan');

        if (auth()->user()->level == 'admin' || auth()->user()->level == 'superadmin' || auth()->user()->level == 'verifikator') {
            return redirect()->route('jamkesda.selesai');
        }

        return redirect()->route('pengajuan.selesai');


        // dd($request);
        // $validate = $request->validate([
        //     'no_rm' => 'required',
        //     'tgl_keluar' => 'required',
        //     'los' => 'required',
        //     'jenis_rs' => 'required',
        //     'diagnosa' => 'required',
        //     'tarif_inacbgs' => 'required',
        //     'tarif_rs' => 'required',
        //     'biaya_lainnya' => 'required',
        //     'total_biaya' => 'required',
        //     'pasien_pulang' =>  ['required', 'mimes:pdf', 'max:2000']
        // ], [
        //     'no_rm.required' => 'Form input harap diisi',
        //     'tgl_keluar.required' => 'Form input harap diisi',
        //     'los.required' => 'Form input harap diisi',
        //     'jenis_rs.required' => 'Form input harap diisi',
        //     'diagnosa.required' => 'Form input harap diisi',
        //     'tarif_inacbgs.required' => 'Form input harap diisi',
        //     'tarif_rs.required' => 'Form input harap diisi',
        //     'biaya_lainnya.required' => 'Form input harap diisi',
        //     'total_biaya.required' => 'Form input harap diisi',
        //     'pasien_pulang.required' => 'Form input Berkas Pasien Pulang harap diisi',
        //     'pasien_pulang.mimes' => 'File berkas pasien pulang harus berupa PDF',
        //     'pasien_pulang.max' => 'Ukuran file berkas pasien pulang tidak boleh lebih dari 2MB',
        // ]);

        // $pasien_id  = $request->pasien_id;
        // $attr = [
        //     'pasien_id' => $request->pasien_id,
        //     'no_rm' => $request->no_rm,
        //     'tgl_keluar' => $request->tgl_keluar,
        //     'los' => $request->los,
        //     'jenis_rs' => $request->jenis_rs,
        //     'diagnosa' => $request->diagnosa,
        //     'tarif_inacbgs' => $request->tarif_inacbgs,
        //     'tarif_rs' => $request->tarif_rs,
        //     'biaya_lainnya' => $request->biaya_lainnya,
        //     'total_biaya' => $request->total_biaya,
        //     'keterangan' => '0',
        //     // 'tgl_pembayaran_tagihan' => $request->tgl_pembayaran_tagihan
        // ];

        // $pembayaran = Pembayaran::where('pasien_id', $pasien_id);
        // if ($pembayaran->count()) {
        //     $insert = $pembayaran->first()->update($attr);
        //     Log::logSave('Upadate data tagihan dengan pasien id=' . $pasien_id);
        // } else {
        //     $insert = Pembayaran::create($attr);
        //     Log::logSave('Menambahkan data tagihan dengan pasien id=' . $pasien_id);
        // }

        // if ($insert) {
        //     $data = Persyaratan::where('pasien_id', $pasien_id)->first();

        //     if ($data->pasien_pulang) {
        //         $oldFile = public_path('uploads/pasien_pulang' . '/' . $data->pasien_pulang);
        //         if (file_exists($oldFile)) {
        //             unlink($oldFile);
        //         }
        //     }

        //     $file = $request->file('pasien_pulang');
        //     $ext = $file->getClientOriginalExtension();
        //     $newName = date('dmY') . Str::random(3) . strtoupper($file->getClientOriginalName()[0]) . '.' . $ext;
        //     $file->move('uploads/pasien_pulang', $newName);
        //     $inputFile['pasien_pulang'] = $newName;

        //     $insert2 = $data->update($inputFile);
        //     Log::logSave('Upadate data berkas pasien pulang dengan pasien id = ' . $pasien_id);
        // }

        // if ($insert2) {
        //     $attr2 = [
        //         'pasien_id' => $request->pasien_id,
        //         'inacbgs_id' => $request->diagnosa,
        //         'total' => $request->tarif_inacbgs,
        //     ];

        //     PembayaranInacbgs::create($attr2);
        //     Log::logSave('Menambahkan pembayaran Inacbgs dengan pasien id=' . $pasien_id);

        //     Alert::success('Data Berhasil Ditambahkan');
        //     return redirect()->route('jamkesda.selesai');
        // } else {
        //     Alert::error('Data Gagal Ditambahkan!');
        //     return redirect()->route('jamkesda.selesai');
        // }
    }

    public function editTagihan($pasien_id)
    {
        $pembayaran = Pembayaran::where('pasien_id', $pasien_id)->first();
        $pasien = Pasien::where('pasien_id', $pasien_id)->first();
        $inacbgs = Inacbgs::groupBy('jenis_rs')->get();

        $pembayaranInacbgs = PembayaranInacbgs::with('inacbgs')->where('pasien_id', $pasien_id)->first();

        return view('pages.admin.pembayaran.update-pembayaran', compact('pembayaran', 'pasien', 'inacbgs', 'pembayaranInacbgs'));
    }

    public function updateTagihan(Request $request)
    {

        $validate = $request->validate([
            'no_rm' => ['required'],
            'tgl_keluar' => ['required'],
            'los' => ['required'],
            'jenis_rs' => ['required'],
            'diagnosa' => ['required'],
            'tarif_inacbgs' => ['required'],
            'tarif_rs' => ['required'],
            'biaya_lainnya' => ['required'],
            'total_biaya' => ['required'],

        ], [
            'no_rm.required' => 'Form input harap diisi',
            'tgl_keluar.required' => 'Form input harap diisi',
            'los.required' => 'Form input harap diisi',
            'jenis_rs.required' => 'Form input harap diisi',
            'diagnosa.required' => 'Form input harap diisi',
            'tarif_inacbgs.required' => 'Form input harap diisi',
            'tarif_rs.required' => 'Form input harap diisi',
            'biaya_lainnya.required' => 'Form input harap diisi',
            'total_biaya.required' => 'Form input harap diisi',

        ]);

        $pasien_id = $request->pasien_id;
        $attr = [
            'pasien_id' => $request->pasien_id,
            'no_rm' => $request->no_rm,
            'tgl_keluar' => $request->tgl_keluar,
            'los' => $request->los,
            'jenis_rs' => $request->jenis_rs,
            'diagnosa' => $request->diagnosa,
            'tarif_inacbgs' => $request->tarif_inacbgs,
            'tarif_rs' => $request->tarif_rs,
            'biaya_lainnya' => $request->biaya_lainnya,
            'total_biaya' => $request->total_biaya,
            'keterangan' => '0',
        ];

        $pembayaran = Pembayaran::where('pasien_id', $pasien_id);
        if ($pembayaran->exists()) {
            $pembayaran->first()->update($attr);
            Log::logSave('Update data tagihan dengan pasien id=' . $pasien_id);
        } else {
            Pembayaran::create($attr);
            Log::logSave('Menambahkan data tagihan dengan pasien id=' . $pasien_id);
        }

        if (isset($request->pasien_pulang)) {
            $data = Persyaratan::where('pasien_id', $pasien_id)->first();

            if ($data && $data->pasien_pulang) {
                $oldFile = public_path('uploads/pasien_pulang/' . $data->pasien_pulang);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $file = $request->file('pasien_pulang');
            $ext = $file->getClientOriginalExtension();
            $newName = date('dmY') . Str::random(3) . strtoupper($file->getClientOriginalName()[0]) . '.' . $ext;
            $file->move(public_path('uploads/pasien_pulang'), $newName);
            $inputFile['pasien_pulang'] = $newName;

            $data->update($inputFile);
            Log::logSave('Update data berkas pasien pulang dengan pasien id=' . $pasien_id);
        }

        $attr2 = [
            'pasien_id' => $request->pasien_id,
            'inacbgs_id' => $request->diagnosa,
            'total' => $request->tarif_inacbgs,
        ];

        PembayaranInacbgs::create($attr2);
        Log::logSave('Menambahkan pembayaran Inacbgs dengan pasien id=' . $pasien_id);

        Alert::success('Data Berhasil Di Ubah');

        if (auth()->user()->level == 'admin' || auth()->user()->level == 'superadmin' || auth()->user()->level == 'verifikator') {
            return redirect()->route('jamkesda.selesai');
        }

        return redirect()->route('pengajuan.selesai');


        // $pasien_id  = $request->pasien_id;
        // $attr = [
        //     'pasien_id' => $request->pasien_id,
        //     'total_tagihan' => $request->total_tagihan,
        //     'keterangan' => $request->keterangan,
        //     'tgl_pembayaran_tagihan' => $request->tgl_pembayaran_tagihan
        // ];

        // $pembayaran = Pembayaran::where('pasien_id', $pasien_id);
        // if ($pembayaran->count()) {
        //     $insert = $pembayaran->first()->update($attr);
        //     Log::logSave('Upadate data tagihan dengan pasien id=' . $pasien_id);
        //     Alert::success('Data Berhasil Diupdate');
        //     return redirect()->route('jamkesda.selesai');
        // } else {
        //     $insert = Pembayaran::create($attr);
        //     Log::logSave('Menambahkan data tagihan dengan pasien id=' . $pasien_id);
        //     Alert::success('Data Berhasil Diupdate');
        //     return redirect()->route('jamkesda.selesai');
        // }
    }

    public function hapusTagihan($pasien_id)
    {
        $pembayaran = Pembayaran::where('pasien_id', $pasien_id)->first();

        if ($pembayaran->total_pembayaran != null) {
            $attr['total_tagihan'] = null;
            $attr['keterangan'] =  3;
            $attr['tgl_pembayaran_tagihan'] = null;
            $delete = $pembayaran->update($attr);
        } else {
            $delete = $pembayaran->delete();
        }

        if ($delete) {
            $pembayaran_inacbgs = PembayaranInacbgs::where('pasien_id', $pasien_id)->first()->delete();
            Log::logSave('Hapus pembayaran Inacbgs dengan pasien id=' . $pasien_id);

            Alert::success('Data Berhasil Dihapuskan');

            if (auth()->user()->level == 'admin' || auth()->user()->level == 'superadmin' || auth()->user()->level == 'verifikator') {
                return redirect()->route('jamkesda.selesai');
            }

            return redirect()->route('pengajuan.selesai');
        } else {
            Alert::error('Data Gagal Dihapuskan');

            if (auth()->user()->level == 'admin' || auth()->user()->level == 'superadmin' || auth()->user()->level == 'verifikator') {
                return redirect()->route('jamkesda.selesai');
            }

            return redirect()->route('pengajuan.selesai');
        }
    }

    public function simpanPembayaran(Request $request)
    {
        $pasien_id = $request->pasien_id;
        $attr = [
            'pasien_id' => $pasien_id,
            'total_pembayaran' => $request->total_pembayaran,
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'keterangan' => 3
        ];

        $pembayaran = Pembayaran::where('pasien_id', $pasien_id);
        if ($pembayaran->count() != null) {
            $data = $pembayaran->first()->update($attr);
            Log::logSave('Update pembayaran oleh Verifikator dengan pasien id=' . $pasien_id);
        } else {
            $data = Pembayaran::create($attr);
            Log::logSave('Simpan pembayaran oleh Verifikator dengan pasien id=' . $pasien_id);
        }

        if ($data) {
            Alert::success('Data Berhasil Dinputkan');
            return redirect()->route('jamkesda.selesai');
        } else {
            Alert::error('Data Gagal Diinputkan');
            return redirect()->route('jamkesda.selesai');
        }
    }

    public function editPembayaran($pasien_id)
    {
        $pembayaran = Pembayaran::where('pasien_id', $pasien_id)->first();

        return view('pages.admin.jamkesda.pembayaran.edit', compact('pembayaran'));
    }

    public function updatePembayaran(Request $request)
    {
        $pasien_id = $request->pasien_id;
        $attr = [
            'pasien_id' => $pasien_id,
            'total_pembayaran' => $request->total_pembayaran,
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'keterangan' => 3
        ];

        $pembayaran = Pembayaran::where('pasien_id', $pasien_id);
        if ($pembayaran->count() != null) {
            $data = $pembayaran->first()->update($attr);
            Log::logSave('Update pembayaran oleh Verifikator dengan pasien id=' . $pasien_id);
        } else {
            $data = Pembayaran::create($attr);
            Log::logSave('Simpan pembayaran oleh Verifikator dengan pasien id=' . $pasien_id);
        }

        if ($data) {
            Alert::success('Data Berhasil Dinputkan');
            return redirect()->route('jamkesda.selesai');
        } else {
            Alert::error('Data Gagal Diinputkan');
            return redirect()->route('jamkesda.selesai');
        }
    }

    public function hapusPembayaran($pasien_id)
    {
        $pembayaran = Pembayaran::where('pasien_id', $pasien_id)->first();

        if ($pembayaran->total_tagihan != null) {
            $attr['tgl_pembayaran'] = null;
            $attr['total_pembayaran'] = null;
            $delete = $pembayaran->update($attr);
        } else {
            $delete = $pembayaran->delete();
        }

        if ($delete) {
            Log::logSave('Hapus pembayaran dengan pasien id=' . $pasien_id);

            Alert::success('Data Berhasil Dihapuskan');
            return redirect()->route('jamkesda.selesai');
        } else {
            Alert::error('Data Gagal Dihapuskan');
            return redirect()->route('jamkesda.selesai');
        }
    }

    public function ajaxInacbgs(Request $request)
    {
        $jenis_rs = $request->jenis_rs;
        $inacbgs = Inacbgs::where('jenis_rs', $jenis_rs)->get();
        $data = array();
        foreach ($inacbgs as $item) {
            $data[] = array(
                'id' => $item->id,
                'kode' => str_replace("‐", "-", $item->kode),
                'deskrpsi' => $item->deskrpsi
            );
        }
        return response()->json(['success' => 'Data Berhasil Diambil', 'data' => $data]);
    }

    public function ajaxDiagnosa(Request $request)
    {
        $id = $request->id;
        $tarif = Inacbgs::where('id', $id)->pluck('tarif');
        return response()->json(['success' => 'Data Berhasil Diambil', 'tarif' => $tarif]);
    }

    public function byNik(Request $request)
    {
        $nik = $request->nik;

        $pasien = Pasien::with('rumahsakit')->where('status', 'Diterima')->where('no_ktp', $nik)->get();

        return ResponseFormatter::success($pasien);
    }
}
