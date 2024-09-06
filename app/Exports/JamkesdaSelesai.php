<?php

namespace App\Exports;

use App\Models\Pasien;
use App\Models\Pembayaran;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromView;

class JamkesdaSelesai implements FromView
{

    protected $data;

    function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {

        $tgl_diterima1 = $this->data['tgl_diterima1'];
        $tgl_diterima2 = $this->data['tgl_diterima2'];
        $rs = $this->data['rs'];
        $keterangan = $this->data['keterangan'];

        if ($rs == "all") {
            if ($keterangan == 3) {
                $query = Pasien::with(['pembayaran'], ['kelurahan' => function ($key) {
                    $key->with('kecamatan');
                }], 'rumahsakit')->where('status', 'Diterima')->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->get();
                $data1 = Pasien::with('pembayaran', 'kelurahan', 'rumahsakit')->leftJoin('pembayaran', 'pasien.pasien_id', '=', 'pembayaran.pasien_id')->where('status', 'Diterima')->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->sum('total_tagihan');
                $data2 = Pasien::with('pembayaran', 'kelurahan', 'rumahsakit')->leftJoin('pembayaran', 'pasien.pasien_id', '=', 'pembayaran.pasien_id')->where('status', 'Diterima')->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->sum('total_pembayaran');
            } else {
                $query = Pasien::with('pembayaran', 'kelurahan', 'rumahsakit')->where('status', 'Diterima')->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->get();
                $data1 = Pasien::with('pembayaran', 'kelurahan', 'rumahsakit')->leftJoin('pembayaran', 'pasien.pasien_id', '=', 'pembayaran.pasien_id')->where('pembayaran.keterangan', $keterangan)->where('status', 'Diterima')->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->sum('total_tagihan');
                $data2 = Pasien::with('pembayaran', 'kelurahan', 'rumahsakit')->leftJoin('pembayaran', 'pasien.pasien_id', '=', 'pembayaran.pasien_id')->where('pembayaran.keterangan', $keterangan)->where('status', 'Diterima')->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->sum('total_pembayaran');
            }
        } else {
            if ($keterangan == 3) {
                $query = Pasien::with('pembayaran', ['kelurahan' => function (Builder $key) {
                    $key->with('kecamatan');
                }], 'rumahsakit')->where('status', 'Diterima')->where('kode_rs', $rs)->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->get();
                $data1 = Pasien::with('pembayaran', 'kelurahan', 'rumahsakit')->leftJoin('pembayaran', 'pasien.pasien_id', '=', 'pembayaran.pasien_id')->where('status', 'Diterima')->where('kode_rs', $rs)->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->sum('total_tagihan');
                $data2 = Pasien::with('pembayaran', 'kelurahan', 'rumahsakit')->leftJoin('pembayaran', 'pasien.pasien_id', '=', 'pembayaran.pasien_id')->where('status', 'Diterima')->where('kode_rs', $rs)->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->sum('total_pembayaran');
            } else {
                $query = Pasien::with([
                    'pembayaran',
                    'kelurahan.kecamatan',
                    'rumahsakit'
                ])
                    ->where('status', 'Diterima')
                    ->where('kode_rs', $rs)
                    ->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])
                    ->get();
                $data1 = Pasien::with('pembayaran', 'kelurahan', 'rumahsakit')->leftJoin('pembayaran', 'pasien.pasien_id', '=', 'pembayaran.pasien_id')->where('pembayaran.keterangan', $keterangan)->where('status', 'Diterima')->where('kode_rs', $rs)->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->sum('total_tagihan');
                $data2 = Pasien::with('pembayaran', 'kelurahan', 'rumahsakit')->leftJoin('pembayaran', 'pasien.pasien_id', '=', 'pembayaran.pasien_id')->where('pembayaran.keterangan', $keterangan)->where('status', 'Diterima')->where('kode_rs', $rs)->whereBetween('tgl_diterima', [$tgl_diterima1, $tgl_diterima2])->sum('total_pembayaran');
            }
        }


        return view('exports.jamkesda', [
            'jmlh_tagihan' => $data1,
            'jmlh_pembayaran' => $data2,
            'data' => $query
        ]);
    }
}
