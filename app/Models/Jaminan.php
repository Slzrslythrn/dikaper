<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jaminan extends Model
{
    use HasFactory;

    protected $table = 'jaminan';

    protected $primaryKey = 'ROW_ID';

    protected $fillable = [
        'tahun',
        'bulan',
        'tanggal',
        'puskesmas',
        'ada_rujukan',
        'no_surat_rujuk',
        'rs_merawat',
        'nama',
        'tgl_mulai_rawat',
        'sex',
        'tgl_lahir',
        'tempat_lahir',
        'umur',
        'ada_jamkesda',
        'no_jamkesda',
        'ada_sktm',
        'no_sktm',
        'alamat',
        'desa',
        'kecamatan',
        'ada_kk',
        'no_kk',
        'nama_kk',
        'hub_kk',
        'diagnosa',
        'pemeriksaan',
        'ada_ktp',
        'ada_ktp',
        'no_ktp',
        'no_surat_jaminan',
        'jenis_rawat',
        'jenis_rawat_lain',
        'dijamin_sejak',
        'dijamin_selama',
        'ada_rujuk_rs_asal',
        'rs_rujuk_asal',
        'jaminan_kelas_rs',
        'jaminan_ruang_rs',
        'creator',
        'created',
        'editor',
        'edited',
    ];

    // protected $dates = ['tanggal_lahir'];

    public $timestamps = false;
}
