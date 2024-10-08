<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $primaryKey = 'kecamatan_id';

    protected $fillable = [
        'kecamatan_id',
        'kecamatan_nama'
    ];

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class, 'kecamatan_id');
    }
}
