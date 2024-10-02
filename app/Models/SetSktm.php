<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetSktm extends Model
{
    use HasFactory;

    protected $table = 'set_sktm';

    protected $primaryKey = 'id';

    protected $fillable = ['no_sktm'];
}
