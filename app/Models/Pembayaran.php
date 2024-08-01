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
        'total_tagihan',
        'total_pembayaran',
        'keterangan',
        'tgl_pembayaran_tagihan',
        'tgl_pembayaran',
    ];

    public $timestamps = false;

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'pasien_id');
    }
}
