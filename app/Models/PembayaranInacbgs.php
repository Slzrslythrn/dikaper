<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranInacbgs extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_inacbgs';

    protected $fillable = [
        'pasien_id',
        'inacbgs_id',
        'total',
    ];

    public $timestamps = false;

    public function inacbgs()
    {
        return $this->belongsTo(Inacbgs::class, 'inacbgs_id', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}
