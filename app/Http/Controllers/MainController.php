<?php

namespace App\Http\Controllers;

use App\Models\Logaktivitas;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $users_id = auth()->user()->id;
        $pasien = Pasien::where('users_id', $users_id)->get();

        $totalPasien = $pasien->count();
        $totalDiterima = $pasien->where('status', 'Diterima')->count();
        $totalDitolak = $pasien->where('status', 'Ditolak')->count();
        $totalDikembalikan = $pasien->where('status', 'Dikembalikan')->count();
        $totalDiproses = $pasien->where('status', 'Diproses')->count();
        $totalDraft = $pasien->where('status', 'Draft')->count();

        return view('dashboard', compact('totalPasien', 'totalDiterima', 'totalDitolak', 'totalDikembalikan', 'totalDiproses', 'totalDraft'));
    }

    public function log()
    {
        Carbon::setLocale('id');
        $logs = Logaktivitas::where('users_id', auth()->user()->id)->get();

        $draft = Pasien::with('rumahsakit')->select('kode_rs', DB::raw('COUNT(*) as count'))->where('status', 'Draft')->groupBy('kode_rs')->get();
        $proses = Pasien::with('rumahsakit')->select('kode_rs', DB::raw('COUNT(*) as count'))->where('status', 'Diproses')->groupBy('kode_rs')->get();
        $diterima = Pasien::with('rumahsakit')->select('kode_rs', DB::raw('COUNT(*) as count'))->where('status', 'Diterima')->groupBy('kode_rs')->get();
        $ditolak = Pasien::with('rumahsakit')->select('kode_rs', DB::raw('COUNT(*) as count'))->where('status', 'Ditolak')->groupBy('kode_rs')->get();
        // dd($draft);

        return view('log', compact('logs', 'draft', 'proses', 'diterima', 'ditolak'));
    }
}
