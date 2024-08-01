<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logaktivitas extends Model
{
    use HasFactory;

    protected $table = 'logaktivitas';

    protected $primaryKey = 'logaktivitas_id';

    protected $fillable = [
        'users_id',
        'aktivitas',
        'waktu',
    ];

    protected $dates = ['waktu'];
    public $timestamps = false;
}
