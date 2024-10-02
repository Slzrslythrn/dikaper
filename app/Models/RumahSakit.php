<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    use HasFactory;

    protected $table = 'rumahsakit';

    protected $primaryKey = 'kode';

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'kode_jenis',
        'kelas',
        'strata',
        'ref_tarif_jamkesda',
        'ref_tarif_jamkesmas',
        'users_id'
    ];

    public $timestamps = false;

    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'kode_rs', 'kode');
    }

    // public function pasien()
    // {
    //     return $this->hasMany(Pasien::class, 'kode_rs', 'kode','rumahsakit_id');

    // }
}
