<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baznas extends Model
{
    use HasFactory;

    protected $table = 'baznas';

    protected $fillable = [
        'no_surat',
        'tgl_surat',
        'nama',
        'tgl_lahir',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'tunggakan_bpjs',
        'denda_layanan',
        'ket',
    ];

    public static function getNextNoSurat()
    {
        $lastRecord = self::orderBy('id', 'desc')->first();

        if ($lastRecord) {
            // Extract the number part from "No Surat"
            preg_match('/460\/(\d{3})\/R\/B$/', $lastRecord->no_surat, $matches);
            $lastNoSurat = isset($matches[1]) ? intval($matches[1]) : 0;
            $nextNoSurat = $lastNoSurat + 1;
        } else {
            $nextNoSurat = 1; // Start from 1 if no records found
        }

        // Format the next number, e.g., "460/001/R/B"
        $nextNoSuratFormatted = str_pad($nextNoSurat, 3, '0', STR_PAD_LEFT);
        return '460/' . $nextNoSuratFormatted . '/R/B';
    }
    public $timestamps = false;
}
