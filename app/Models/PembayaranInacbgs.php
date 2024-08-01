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
}
