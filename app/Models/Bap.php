<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bap extends Model
{
    use HasFactory;

    protected $table = 'bap';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'rumahsakit_id',
        'tanggal',
        'draft_bap',
        'bap',

    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rumahsakit()
    {
        return $this->belongsTo(RumahSakit::class, 'rumahsakit_id', 'kode');
    }
}
