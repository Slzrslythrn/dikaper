<?php

namespace App\Http\Controllers;

use App\Helpers\Log;
use App\Models\RumahSakit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class DataRumahSakitController extends Controller
{
    public function index()
    {
        $rumahsakit = RumahSakit::orderBy('nama', 'DESC')->get();
        return view('pages.admin.data-rumahSakit', compact('rumahsakit'));
    }

    public function buat()
    {
        $user = User::where('level', 'rumahsakit')->get();

        return view('pages.admin.rumahsakit.buat', compact('user'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'kode' => ['required', 'numeric', 'unique:rumahsakit,kode'],
            'nama' => ['required'],
            'alamat' => ['required'],
            'kode_jenis' => ['required'],
            'kelas' => ['required'],
            'strata' => ['required'],
            'ref_tarif_jamkesda' => ['required'],
            'ref_tarif_jamkesmas' => ['required'],
            'users_id' => ['required'],
        ], [
            'kode.required' => 'Harap Menginputkan Data',
            'nama.required' => 'Harap Menginputkan Data',
            'alamat.required' => 'Harap Menginputkan Data',
            'kode_jenis.required' => 'Harap Menginputkan Data',
            'kelas.required' => 'Harap Menginputkan Data',
            'strata.required' => 'Harap Menginputkan Data',
            'ref_tarif_jamkesda.required' => 'Harap Menginputkan Data',
            'ref_tarif_jamkesmas.required' => 'Harap Menginputkan Data',
            'users_id.required' => 'Harap Menginputkan Data',
        ]);

        $attr = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kode_jenis' => $request->kode_jenis,
            'kelas' => $request->kelas,
            'strata' => $request->strata,
            'ref_tarif_jamkesda' => $request->ref_tarif_jamkesda,
            'ref_tarif_jamkesmas' => $request->ref_tarif_jamkesmas,
            'users_id' => $request->users_id,
        ];

        $rumahSakit = RumahSakit::where('users_id', $request->users_id)->first();

        if ($rumahSakit) {
            Alert::error('Akun User sudah digunakan !!!');
            return redirect()->back()->withInput();
        }

        $simpan = RumahSakit::create($attr);

        Log::logSave('Membuat Rumah Sakit Baru ' . $request->kode);
        Alert::success('Data Berhasil Dinputkan');
        return redirect()->route('data-rumahSakit');
    }

    public function edit($kode)
    {
        $rumahsakit = RumahSakit::findOrFail($kode);
        $user = User::where('level', 'rumahsakit')->get();

        return view('pages.admin.rumahsakit.edit', compact('rumahsakit', 'user'));
    }

    public function update(Request $request, $kode)
    {
        $rumahsakit = RumahSakit::findOrFail($kode);

        $request->validate([
            'kode' => ['required', 'numeric', Rule::unique('rumahsakit')->ignore($rumahsakit)],
            'nama' => ['required'],
            'alamat' => ['required'],
            'kode_jenis' => ['required'],
            'kelas' => ['required'],
            'strata' => ['required'],
            'ref_tarif_jamkesda' => ['required'],
            'ref_tarif_jamkesmas' => ['required'],
            'users_id' => ['required'],
        ], [
            'kode.required' => 'Harap Menginputkan Data',
            'nama.required' => 'Harap Menginputkan Data',
            'alamat.required' => 'Harap Menginputkan Data',
            'kode_jenis.required' => 'Harap Menginputkan Data',
            'kelas.required' => 'Harap Menginputkan Data',
            'strata.required' => 'Harap Menginputkan Data',
            'ref_tarif_jamkesda.required' => 'Harap Menginputkan Data',
            'ref_tarif_jamkesmas.required' => 'Harap Menginputkan Data',
            'users_id.required' => 'Harap Menginputkan Data',
        ]);

        $attr = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kode_jenis' => $request->kode_jenis,
            'kelas' => $request->kelas,
            'strata' => $request->strata,
            'ref_tarif_jamkesda' => $request->ref_tarif_jamkesda,
            'ref_tarif_jamkesmas' => $request->ref_tarif_jamkesmas,
            'users_id' => $request->users_id,
        ];

        // Cek jika users_id sudah digunakan di record lain
        $dataRumahsakit = RumahSakit::where('users_id', $request->users_id)
            ->where('kode', '!=', $rumahsakit->kode)
            ->first();

        if ($dataRumahsakit) {
            Alert::error('Akun User sudah digunakan !!!');
            return redirect()->back()->withInput();
        }

        $update = $rumahsakit->update($attr);

        Log::logSave('Mengedit Data Rumah Sakit ' . $request->kode);
        Alert::success('Data Berhasil Diedit');
        return redirect()->route('data-rumahSakit');
    }

    public function destroy($kode)
    {
        $rumahsakit = RumahSakit::findOrFail($kode);
        Log::logSave('Menghapus Data Rumah Sakit ' . $kode);

        $hapus = $rumahsakit->delete();
        Alert::success('Data Berhasil Dihapus');
        return redirect()->route('data-rumahSakit');
    }
}
