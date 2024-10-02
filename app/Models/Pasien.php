<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $primaryKey = 'pasien_id';

    protected $fillable = [
        'pasien_id',
        'users_id',
        'no_peserta',
        'no_sktm',
        'nama_pasien',
        'nama_pkm',
        'no_rujuk_igd',
        'no_ktp',
        'no_kk',
        'nama_kepala',
        'hubungan_kk',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'kelurahan_id',
        'alamat',
        'diagnosa',
        'kode_rs',
        'tgl_mulairawat',
        'jenis_rawat',
        'dikelas',
        'dijamin_sejak',
        'status',
        'keterangan_status',
        'tgl_diterima',
        'ket_jamkesda',
        'no_sjp',
        'status_kepersertaan',
    ];

    protected $dates = ['tanggal_lahir', 'dijamin_sejak'];

    public $timestamps = false;

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'kelurahan_id');
    }

    public function persyaratan()
    {
        return $this->hasOne(Persyaratan::class, 'pasien_id');
    }

    public function rumahsakit()
    {
        return $this->belongsTo(RumahSakit::class, 'kode_rs', 'kode');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pasien_id');
    }

    public function pembayaranInacbgs()
    {
        return $this->hasOne(PembayaranInacbgs::class, 'pasien_id');
    }

    // public function noSktm()
    // {
    //     return $this->belongsTo(NoSktm::class, 'no_sktm', 'id');
    // }
}
