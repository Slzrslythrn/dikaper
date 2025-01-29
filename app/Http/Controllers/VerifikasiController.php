<?php

namespace App\Http\Controllers;

use App\Helpers\Log;
use App\Models\Bap;
use App\Models\RumahSakit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class VerifikasiController extends Controller
{

    public function index()
    {


        $bapCollection = Bap::with('rumahsakit')
            ->orderBy('id', 'DESC')
            ->get();

        $bapCollection->each(function ($bap) {
            if (!$bap->rumahsakit) {
                $rumahsakit = DB::select(
                    'SELECT * FROM rumahsakit rs WHERE rs.kode = :kode_rs LIMIT 1',
                    ['kode_rs' => $bap->rumahsakit_id]
                );

                $rumahsakit = $rumahsakit ? $rumahsakit[0] : null;

                // Tambahkan hasil query sebagai atribut rumahsakit ke objek pasien
                $bap->rumahsakit = $rumahsakit;
            }
        });

        return view('pages.admin.verifikasi.page', [
            'bap' => $bapCollection
        ]);
    }

    public function getBuatBap()
    {

        $rumahsakit =  DB::table('rumahsakit')->get();

        return view('pages.admin.verifikasi.buat_bap', compact('rumahsakit'));
    }

    public function postBuatBap(Request $request)
    {
        $validate = $request->validate([
            'tanggal' => 'required',
            'rumahsakit_id' => 'required',
            'draft_bap' => 'required|mimes:pdf,xlsx,docx|max:2000',
        ]);

        $file = $request->file('draft_bap');
        $ext = $file->getClientOriginalExtension();
        $fileName = date('dmY') . Str::random(10) . strtoupper('draft_bap') . '.' . $ext;
        $file->move('uploads/draft_bap', $fileName);

        $attr = [
            'user_id' => auth()->user()->id,
            'rumahsakit_id' => $request->rumahsakit_id,
            'tanggal' => $request->tanggal,
            'draft_bap' => $fileName,
        ];

        $postData = Bap::create($attr);
        Log::logSave('Membuat dan mengupload draft BAP');
        Alert::success('Pengunggahan Draft BAP Telah Selesai');
        return  redirect()->route('verifikasi');
    }

    public function getVerifBap($bapId)
    {
        $id = $bapId;

        $bap = Bap::where('id', $id)->first();

        $rumahsakit = DB::select(
            'SELECT * FROM rumahsakit rs WHERE rs.kode = :kode_rs LIMIT 1',
            ['kode_rs' => $bap->rumahsakit_id]
        );

        $rumahsakit = $rumahsakit ? $rumahsakit[0] : null;

        return view('pages.admin.verifikasi.verifikasi', compact('id', 'bap', 'rumahsakit'));
    }

    public function putVerifBap(Request $request, $bapId)
    {
        $validate = $request->validate([
            'bap' => 'required|mimes:pdf,xlsx,docx|max:2000',
        ]);

        $file = $request->file('bap');
        $ext = $file->getClientOriginalExtension();
        $fileName = date('dmY') . Str::random(10) . strtoupper('bap') . '.' . $ext;
        $file->move('uploads/bap', $fileName);

        $getData = Bap::where('id', $bapId)->first();

        $getData->update(['bap' => $fileName]);

        Log::logSave('Membuat dan mengupload verifikasi BAP');
        Alert::success('Pengunggahan verifikasi BAP Telah Selesai');
        return  redirect()->route('verifikasi');
    }
}
