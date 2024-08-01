<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'kelurahan';

    protected $primaryKey = 'kelurahan_id';

    protected $fillable = [
        'kelurahan_id',
        'kecamatan_id',
        'kelurahan_nama'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'kecamatan_id');
    }

    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'kelurahan_id');
    }
}
