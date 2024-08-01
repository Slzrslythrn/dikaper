<?php

namespace App\Http\Controllers;

use App\Models\Jaminan;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $jaminan = Jaminan::select(['nama', 'no_ktp', 'alamat', 'no_ktp', 'tanggal', 'bulan', 'tahun', 'tgl_lahir'])->get();
        return view('pages.admin.pasien.page', compact('jaminan'));
    }

    public function show($pasien_id)
    {
        // Mengambil data pasien dengan relasi persyaratan
        $pasien = Pasien::with('persyaratan')->find($pasien_id);

        // Memastikan $pasien tidak null sebelum melewatkan ke view
        if (!$pasien) {
            abort(404); // Atau Anda bisa menangani kasus ini sesuai kebutuhan aplikasi Anda
        }

        return view('pasien.show', compact('pasien'));
    }
}
