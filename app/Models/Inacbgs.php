<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inacbgs extends Model
{
    use HasFactory;

    protected $table = 'inacbgs';

    protected $fillable = [
        'jenis_rs',
        'kode',
        'deskripsi',
        'tarif',
    ];

    public $timestamps = false;

    public function pembayaran_inacbgs()
    {
        return $this->hasMany(PembayaranInacbgs::class, 'inacbgs_id', 'id');
    }
}
