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
        $pasien = Pasien::with('rumahsakit')->where('status', 'Diproses')->get();
        $tahun = Session::get('tahun'); // Mengambil tahun dari session, default ke tahun sekarang



        $pasien = Pasien::whereYear('tgl_diterima', $tahun)->get();
        return view('pages.admin.jamkesda.page', compact('pasien'));
    }

    public function tambah()
    {
        $kelurahan = Kelurahan::with('kecamatan')->get();
        $rumas = DB::table('rumahsakit')->get();
        return view('pages.admin.jamkesda.buat', compact('kelurahan', 'rumas'));
    }

    public function buat(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|max:16|min:16',
            'no_kk' => 'required|max:16|min:16',
            'nama_kepala' => 'required',
            'nama_pasien' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelurahan_id' => 'required',
            'alamat' => 'required',
            'hubungan_kk' => 'required',
            'ket_jamkesda' => 'required',
            // 'ktp_kk' => 'required',
            // 'va' => 'required',

        ], [
            'no_ktp.required' => 'Form input harap diisi',
            'no_kk.required' => 'Form input harap diisi',
            'nama_kepala.required' => 'Form input harap diisi',
            'nama_pasien.required' => 'Form input harap diisi',
            'jenis_kelamin.required' => 'Form input harap diisi',
            'tempat_lahir.required' => 'Form input harap diisi',
            'tanggal_lahir.required' => 'Form input harap diisi',
            'kelurahan_id.required' => 'Form input harap diisi',
            'alamat.required' => 'Form input harap diisi',
            'hubungan_kk.required' => 'Form input harap diisi',
            'ket_jamkesda.required' => 'Form input harap diisi',
            // 'ktp_kk.required' => 'Form input harap diisi',
            // 'va.required' => 'Form input harap diisi',
        ]);

        // create a pasien id
        $getPasienId = Pasien::orderBy('pasien_id', 'DESC')->first();
        if (empty($getPasienId)) {
            $pasien_id = '1';
        } else {
            $urut = $getPasienId->pasien_id + 1;
            $pasien_id = $urut;
        }
        // end

        // store function
        $attr = [
            'pasien_id' => $pasien_id,
            'users_id' => auth()->user()->id,
            'no_peserta' => '410/' . $pasien_id . '/SKTM/' . date('Y'),
            'no_ktp' => $request->no_ktp,
            'no_kk' => $request->no_kk,
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
            'keterangan_status' => '',
            'no_sktm' => '0',
            'nama_pkm' => '-',
            'no_rujuk_igd' => '0',
            'diagnosa' => '-',
            'kode_rs' => $request->kode_rs,
            'tgl_mulairawat' => now(),
            'dikelas' => '-',
            'dijamin_sejak' => now(),
            'tgl_diterima' => now(),
        ];
        $store = Pasien::create($attr);
        $attr2 = [];

        if ($request->hasFile('ktp_kk')) {
            $files = $request->file('ktp_kk');

            foreach ($files as $index => $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = date('dmY') . Str::random(3);

                if ($index == 0) {
                    $newName = $fileName . 'KK' . '.' . $ext;
                    $file->move('uploads/ktpKk', $newName);
                    $attr2['ktp_kk'] = $newName; // Adjust path and file name for KTP
                } elseif ($index == 1) {
                    $newName = $fileName . 'BPB' . '.' . $ext;
                    $file->move('uploads/buktiPendaftaranBpjs', $newName);
                    $attr2['va'] = $newName; // Adjust path and file name for KK
                }
            }
        }

        if ($request->hasFile('doc')) {
            $file = $request->file('doc')[0];
            $ext = $file->getClientOriginalExtension();
            $newName =  date('dmY') . Str::random(3) . 'DOC' .  '.' . $ext;
            $file->move('uploads/doc', $newName);
            $attr2['doc'] = $newName;
        }

        $attr2['pasien_id'] = $pasien_id;
        // dd($attr2);
        $store2 = Persyaratan::create($attr2);

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
        $pasien = Pasien::with('rumahsakit', 'pembayaran')->where('status', 'Diterima')->orWhere('status', 'Ditolak')->orderBy('tgl_diterima', 'DESC')->get();
        $inacbgs = Inacbgs::groupBy('jenis_rs')->get();
        $rumahsakit = RumahSakit::all();
        // dd($pasien);
        return view('pages.admin.jamkesda.selesai', compact('pasien', 'inacbgs', 'rumahsakit'));
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

        $attr['status'] = 'Diterima';
        $attr['tgl_diterima'] = date('Y-m-d');
        $attr['no_peserta'] = '410/' . $count . '/SKTM/' . date('Y');

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
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'pasien' => $pasien,
            'qrcode' => $qrcode
        ];
        // dd($data);
        // $qrcode = base64_encode(\QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));

        $pdf = PDF::loadView('pages.admin.pdf-diterima', $data);

        return $pdf->stream('jamkesda-diterima.pdf');
    }

    public function simpanTagihan(Request $request)
    {
        $pasien_id  = $request->pasien_id;
        $attr = [
            'pasien_id' => $request->pasien_id,
            'total_tagihan' => $request->total_tagihan,
            'keterangan' => $request->keterangan,
            'tgl_pembayaran_tagihan' => $request->tgl_pembayaran_tagihan
        ];

        $pembayaran = Pembayaran::where('pasien_id', $pasien_id);
        if ($pembayaran->count()) {
            $insert = $pembayaran->first()->update($attr);
            Log::logSave('Upadate data tagihan dengan pasien id=' . $pasien_id);
        } else {
            $insert = Pembayaran::create($attr);
            Log::logSave('Menambahkan data tagihan dengan pasien id=' . $pasien_id);
        }

        if ($insert) {
            $attr2 = [
                'pasien_id' => $request->pasien_id,
                'inacbgs_id' => $request->diagnosa_select,
                'total' => $request->tarif,
            ];

            PembayaranInacbgs::create($attr2);
            Log::logSave('Menambahkan pembayaran Inacbgs dengan pasien id=' . $pasien_id);

            Alert::success('Data Berhasil Ditambahkan');
            return redirect()->route('jamkesda.selesai');
        } else {
            Alert::error('Data Gagal Ditambahkan!');
            return redirect()->route('jamkesda.selesai');
        }
    }

    public function editTagihan($pasien_id)
    {
        $pembayaran = Pembayaran::where('pasien_id', $pasien_id)->first();

        return view('pages.admin.jamkesda.tagihan.edit', compact('pembayaran'));
    }

    public function updateTagihan(Request $request)
    {
        $pasien_id  = $request->pasien_id;
        $attr = [
            'pasien_id' => $request->pasien_id,
            'total_tagihan' => $request->total_tagihan,
            'keterangan' => $request->keterangan,
            'tgl_pembayaran_tagihan' => $request->tgl_pembayaran_tagihan
        ];

        $pembayaran = Pembayaran::where('pasien_id', $pasien_id);
        if ($pembayaran->count()) {
            $insert = $pembayaran->first()->update($attr);
            Log::logSave('Upadate data tagihan dengan pasien id=' . $pasien_id);
            Alert::success('Data Berhasil Diupdate');
            return redirect()->route('jamkesda.selesai');
        } else {
            $insert = Pembayaran::create($attr);
            Log::logSave('Menambahkan data tagihan dengan pasien id=' . $pasien_id);
            Alert::success('Data Berhasil Diupdate');
            return redirect()->route('jamkesda.selesai');
        }
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
            return redirect()->route('jamkesda.selesai');
        } else {
            Alert::error('Data Gagal Dihapuskan');
            return redirect()->route('jamkesda.selesai');
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
