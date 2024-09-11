<?php

namespace App\Http\Controllers;

use App\Helpers\Log;
use App\Models\Kelurahan;
use App\Models\Pasien;
use App\Models\Persyaratan;
use App\Models\RumahSakit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use File;
use Illuminate\Support\Facades\DB;
use PDF;

class PengajuanController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $id = auth()->user()->id;
        // $pasien = Pasien::has('persyaratan')->with('rumahsakit')->where('no_ktp', auth()->user()->nik)->get();
        // $rumahsakit = Rumahsakit::whereHas('pasien', function ($query) use ($nik) {
        //     $query->where('no_ktp', $nik)->has('persyaratan');
        // })->with('pasien')->get();

        // $pasien = Pasien::with(['rumahsakit', 'kelurahan.kecamatan'])
        //     ->where('no_ktp', auth()->user()->nik)
        //     ->has('persyaratan')
        //     ->orderByDesc('pasien_id')
        //     ->get();

        // Ambil data pasien dengan relasi rumahsakit dan kelurahan->kecamatan
        $pasienCollection = Pasien::with(['rumahsakit', 'kelurahan.kecamatan'])
            ->where('users_id', $id)
            ->where('status', '!=', 'Diterima')
            ->has('persyaratan')
            ->orderByDesc('pasien_id')
            ->get();

        // Iterasi setiap pasien untuk cek dan tambahkan data rumahsakit jika null
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

        return view('pages.admin.pengajuan.page', ['pasien' => $pasienCollection]);
    }

    public function buat()
    {
        // $no_ktp = auth()->user()->nik;
        // $pasienCeks = Pasien::where('no_ktp', $no_ktp)->where('status', '!=', 'Draft')->count();

        // kondisi jika user sudah pernah isi form meneruskan setelah draft
        // if ($pasienCeks > 0) {
        //     Alert::error('Anda sudah membuat pengajuan');
        //     return redirect()->route('pengajuan');
        // }

        // kondisi jika user sudah pernah isi form dengan status masih draft
        // $pasien = Pasien::where('no_ktp', auth()->user()->nik)->where('status', 'Draft')->first();

        // jika sudah upload berkas
        // $persyaratan = Pasien::where('no_ktp', $no_ktp)->where('status', '!=', 'Draft')->has('persyaratan')->count();
        // dd($pasienCeks);
        // if ($persyaratan > 0) {
        //     Alert::error('Anda sudah membuat pengajuan');
        //    return redirect()->route('pengajuan');
        //}
        // end


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
            'keterangan_status' => null,

        ];


        // Get kelurahan data
        $kelurahan = Kelurahan::with('kecamatan')->get();

        // Get hospital data
        $rumahSakit = auth()->user()->rumah_sakit; // Adjust this according to how you link the hospital to the user

        // Initialize rumahSakit object if not available
        if (!$rumahSakit) {
            $rumahSakit = (object) [
                'kode' => null,
                'nama' => null,
                'alamat' => null,
                'kode_jenis' => null,
            ];
        }

        return view('pages.admin.pengajuan.buat', compact('kelurahan', 'pasien', 'rumahSakit'));
    }

    public function buatById($pasien_id)
    {
        $pasien = Pasien::where('pasien_id', $pasien_id)->first();
        // Get kelurahan data
        $kelurahan = Kelurahan::with('kecamatan')->get();

        // Get hospital data
        $rumahSakit = auth()->user()->rumah_sakit; // Adjust this according to how you link the hospital to the user

        // Initialize rumahSakit object if not available
        if (!$rumahSakit) {
            $rumahSakit = (object) [
                'kode' => null,
                'nama' => null,
                'alamat' => null,
                'kode_jenis' => null,
            ];
        }

        return view('pages.admin.pengajuan.buat', compact('kelurahan', 'pasien', 'rumahSakit'));
    }




    public function tambahBiodata(Request $request)
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


        ], [
            'no_ktp.required' => 'Form input harap diisi',
            'no_kk.required' => 'Form input harap diisi',
            // 'no_sjp.required' => 'Form Input harap diisi',
            'nama_kepala.required' => 'Form input harap diisi',
            'nama_pasien.required' => 'Form input harap diisi',
            'jenis_kelamin.required' => 'Form input harap diisi',
            'tempat_lahir.required' => 'Form input harap diisi',
            'tanggal_lahir.required' => 'Form input harap diisi',
            'kelurahan_id.required' => 'Form input harap diisi',
            'alamat.required' => 'Form input harap diisi',
            'hubungan_kk.required' => 'Form input harap diisi',
            'ket_jamkesda.required' => 'Form input harap diisi',


        ]);



        if ($request->pasien_id) {
            $pasien = Pasien::findOrFail($request->pasien_id);

            // $validated['status'] = 'Draft';

            $update = $pasien->update($validated);

            Log::logSave('Update Biodata Pasien');


            return redirect()->route('pengajuan.diagnosa.tambah', ['id' => $request->pasien_id,  'ket' => 'baru']);

            // return redirect()->route('pengajuan.buat.upload', ['id' => $request->pasien_id, 'ket' => "update"]);
        }

        // create a pasien id
        $getPasienId = Pasien::orderBy('pasien_id', 'DESC')->first();
        if (empty($getPasienId)) {
            $pasien_id = '1';
        } else {
            $urut = $getPasienId->pasien_id + 1;
            $pasien_id = $urut;
        }
        // end
        // $lastNoSktm = Pasien::max('no_sktm');
        // $newNoSktm = $lastNoSktm ? $lastNoSktm + 1 : 1;

        // store function
        $attr = [
            'pasien_id' => $pasien_id,
            'users_id' => auth()->user()->id,
            'no_peserta' => '410/' . $pasien_id . '/SKTM/' . date('Y'),
            'no_ktp' => $request->no_ktp,
            'no_kk' => $request->no_kk,
            // 'doc'=> $request->doc,
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
            // 'status' => '',
            // 'keterangan_status' => '',
            // 'no_sktm' => $newNoSktm,
            // 'nama_pkm' => '-',
            // 'no_rujuk_igd' => '0',
            // 'diagnosa' => '-',
            // 'kode_rs' => '0',
            // 'tgl_mulairawat' => now(),
            // 'dikelas' => '-',
            // 'dijamin_sejak' => now(),
            'tgl_diterima' => now(),
        ];
        $store = Pasien::create($attr);
        // $attr2 = [];

        // if ($request->hasFile('doc')) {
        //     $file = $request->file('doc')[0];
        //     $ext = $file->getClientOriginalExtension();
        //     $newName =  date('dmY') . Str::random(3) . 'DOC' .  '.' . $ext;
        //     $file->move('uploads/doc', $newName);
        //     $attr2['doc'] = $newName;
        // }

        // $attr2['pasien_id'] = $pasien_id;
        // // dd($attr2);
        // $store2 = Persyaratan::create($attr2);
        // end store function

        Log::logSave('Simpan Biodata Pasien');

        return redirect()->route('pengajuan.diagnosa.tambah', ['id' => $pasien_id, 'ket' => 'baru']);

        // return redirect()->route('pengajuan.buat.upload', ['id' => $pasien_id, 'ket' => "baru"]);
    }

    // public function buatDiagnosa()
    // {
    //     Carbon::setLocale('id');
    //     $pasien = Pasien::with('kelurahan')->where('no_ktp', auth()->user()->nik)->where('users_id', auth()->user()->id)->first();

    //     return view('pages.admin.pengajuan.buat-diagnosa', compact('pasien'));
    // }

    // public function tambahDiagnosa()
    // {
    //     return redirect()->route('pengajuan.buat.upload');
    // }

    public function buatUpload($pasien_id)
    {
        Carbon::setLocale('id');

        $pasien = Pasien::with('kelurahan')
            ->where('pasien_id', $pasien_id)
            ->first();


        return view('pages.admin.pengajuan.buat-upload', compact('pasien'));
    }

    public function tambahUpload(Request $request)
    {

        // Validasi input
        $validated = $request->validate([
            'ktp_kk' =>  ['required', 'mimes:pdf', 'max:2000'],
            'sktm' =>  ['required', 'mimes:pdf', 'max:2000'],
            'doc' =>  ['required', 'mimes:pdf', 'max:2000'],
        ], [
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

        // Temukan data Persyaratan berdasarkan pasien_id
        $data = Persyaratan::where('pasien_id', $request->pasien_id)->first();

        $attr = [];

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
                $attr[$field] = $newName;
            }
        }

        $attr['pasien_id'] = $request->pasien_id;

        $pasien = Pasien::where('pasien_id', $request->pasien_id)->first();
        $pasien->update(['status' => 'Draft', 'keterangan_status' => '']);

        if ($data) {
            // Update data jika sudah ada

            $data->update($attr);
        } else {
            // Simpan data baru jika belum ada
            Persyaratan::create($attr);
        }

        Log::logSave('Upload File Kelengkapan Pengajuan');

        Alert::success('Pengajuan Telah Selesai Dibuat');
        return redirect()->route('pengajuan');
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
        return redirect()->route('pengajuan');
    }

    public function ajukan($pasien_id)
    {
        $attr['status'] = 'Diproses';
        $pasien = Pasien::findOrFail($pasien_id);
        $pasien->update($attr);

        Log::logSave('Mengajukan Data Pengajuan (merubah menjadi diproses)');

        Alert::success('Data Berhasil Diajukan');
        return redirect()->route('pengajuan');
    }

    public function lihat($pasien_id)


    {
        // $pasien = DB::select(
        //     'SELECT p.*, 
        //             rs.*, 
        //             pr.* 
        //      FROM pasien p
        //      LEFT JOIN rumahsakit rs ON p.kode_rs = rs.kode
        //      LEFT JOIN persyaratan pr ON p.pasien_id = pr.pasien_id
        //      WHERE p.pasien_id = :pasien_id
        //      LIMIT 1',
        //     ['pasien_id' => $pasien_id]
        // );

        // Karena DB::select mengembalikan array dari hasil, ambil elemen pertama jika ada
        // $pasien = $pasien ? $pasien[0] : null;

        $pasien = Pasien::with(['persyaratan', 'rumahsakit'])
            ->where('pasien_id', $pasien_id)
            ->first();

        if (!$pasien->rumahsakit) {
            $rumahsakit = DB::select(
                'SELECT * FROM rumahsakit rs
             WHERE rs.kode = :kode_rs
             LIMIT 1',
                ['kode_rs' => $pasien->kode_rs]
            );

            $rumahsakit = $rumahsakit ? $rumahsakit[0] : null;

            // Tambahkan hasil query sebagai atribut rumahsakit ke objek pasien
            $pasien->rumahsakit = $rumahsakit;
        }

        // dd($pasien);

        return view('pages.admin.jamkesda.lihat', compact('pasien'));
    }

    public function diagnosaTambah($pasien_id, $ket)
    {

        $users_id = auth()->user()->id;

        $pasien = Pasien::findOrFail($pasien_id);

        if (auth()->user()->level == 'rumahsakit') {

            $rumahsakit = DB::table('rumahsakit')->where('users_id', $users_id)->first();
        } else {

            $rumahsakit = DB::table('rumahsakit')->get();
        }

        // $rumahsakit = RumahSakit::all();
        // dd($rumahsakit);
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


        $keterangan = $ket;

        return view('pages.admin.pengajuan.buat-diagnosa', compact('pasien', 'puskesmas', 'rumahsakit', 'keterangan'));
    }

    public function diagnosaUpdate(Request $request, $pasien_id, $ket)
    {
        $validated = $request->validate([


            'no_rujuk_igd' => 'required',
            'diagnosa' => 'required',
            'kode_rs' => 'required',
            'tgl_mulairawat' => 'required',
            'jenis_rawat' => 'required',
            'dikelas' => 'required',
            'dijamin_sejak' => 'required',
            // 'tgl_aktif_va' => 'required',
            'status_kepersertaan' => 'required',

        ], [
            'hubungan_kk.required' => 'Form input harap diisi',
            'no_rujuk_igd.required' => 'Form input harap diisi',
            'diagnosa.required' => 'Form input harap diisi',
            'kode_rs.required' => 'Form input harap diisi',
            'tgl_mulairawat.required' => 'Form input harap diisi',
            'jenis_rawat.required' => 'Form input harap diisi',
            'dikelas.required' => 'Form input harap diisi',
            'dijamin_sejak.required' => 'Form input harap diisi',
            // 'tgl_aktif_va.required' => 'Form input harap diisi',
            'status_kepersertaan.required' => 'Form input harap diisi',
        ]);

        $attr = [

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
        ];

        $pasien = Pasien::findOrFail($pasien_id);
        $update = $pasien->update($attr);

        Log::logSave('Menambahkan Diagnosa Pasien');

        // Alert::success('Pengajuan Telah Dilengkapi');
        if ($ket == 'baru') {
            return redirect()->route('pengajuan.buat.upload', ['id' => $pasien_id]);
        } else if ($ket == 'lengkapi') {
            return redirect()->route('pengajuan.lihat', ['id' => $pasien_id]);
        }
    }

    public function download($pasien_id)
    {
        $pasien = Pasien::findOrFail($pasien_id);
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(route('pengajuan.download', ['id' => $pasien_id])));
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'pasien' => $pasien,
            'link' => route('pengajuan.download', ['id' => $pasien_id]),
            'qrcode' => $qrcode

        ];
        // dd($data);
        // $qrcode = base64_encode(\QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));

        $pdf = PDF::loadView('pages.admin.pdf-kelengkapan', $data);

        return $pdf->stream('file-kelengkapan.pdf');
    }

    public function getUpdate($pasien_id)
    {

        $pasien = Pasien::with(['persyaratan', 'rumahsakit', 'kelurahan.kecamatan'])
            ->where('pasien_id', $pasien_id)
            ->first();

        $kelurahan = Kelurahan::with('kecamatan')->get();

        // Get hospital data
        $rumahSakit = auth()->user()->rumah_sakit; // Adjust this according to how you link the hospital to the user

        // Initialize rumahSakit object if not available
        if (!$rumahSakit) {
            $rumahSakit = (object) [
                'kode' => null,
                'nama' => null,
                'alamat' => null,
                'kode_jenis' => null,
            ];
        }

        // dd($pasien);

        return view('pages.admin.pengajuan.buat', compact('pasien', 'kelurahan', 'rumahSakit'));
    }

    public function selesai()
    {
        Carbon::setLocale('id');

        $user_id = auth()->user()->id;

        $pasienCollection = Pasien::with('rumahsakit', 'pembayaran')
            ->where('users_id', $user_id)
            ->where(function ($query) {
                $query->where('status', 'Diterima')
                    ->orWhere('status', 'Ditolak');
            })
            ->orderBy('tgl_diterima', 'DESC')
            ->get();

        $pasienCollection->each(function ($pasien) {
            if (!$pasien->rumahsakit) {
                // Jika rumahsakit tidak ditemukan melalui eager loading, lakukan query manual
                $rumahsakit = DB::table('rumahsakit')
                    ->where('kode', $pasien->kode_rs)
                    ->first();

                // Tambahkan hasil query manual sebagai atribut rumahsakit ke objek pasien
                $pasien->rumahsakit = $rumahsakit;
            }
        });


        $rumahsakit = RumahSakit::where('users_id', $user_id)->first();
        // dd($rumahsakit);

        return view('pages.admin.pengajuan.selesai', [
            'pasien' => $pasienCollection,
            'rumahsakit' => $rumahsakit,
        ]);
    }

    // public function getUpdateUpload($pasien_id)
    // {
    //     Carbon::setLocale('id');
    //     $pasien = Pasien::with('kelurahan')->where('no_ktp', auth()->user()->nik)->where('pasien_id', $pasien_id)->first();

    //     return view('pages.admin.pengajuan.update-upload', compact('pasien'));
    // }
}
