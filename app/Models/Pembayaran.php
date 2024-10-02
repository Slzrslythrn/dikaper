<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pasien_id',
        'tarif_inacbgs',
        'tarif_rs',
        'keterangan',
        'tgl_pembayaran_tagihan',
        'tgl_pembayaran',
        'no_rm',
        'los',
        'tgl_keluar',
        'biaya_lainnya',
        'total_biaya'
    ];

    public $timestamps = false;

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'pasien_id');
    }
}
