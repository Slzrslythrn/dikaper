<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    use HasFactory;

    protected $table = 'persyaratan';

    protected $primaryKey = 'persyaratan_id';

    protected $fillable = [
        'pasien_id',
        'va',
        'surat_pernyataan',
        'rekomendasi',
        'rujukan_pkm',
        'rawat_inap',
        'sktm',
        'ktp_kk',
        'catatan',
        'doc',
        'pasien_pulang'
    ];

    public $timestamps = false;

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'pasien_id');
    }
}
