<?php


// required register helper class in aliases

namespace App\Helpers;

use App\Models\Disposisi;
use App\Models\Logaktivitas;
use App\Models\Perbaikan;
use App\Models\User;

class Log
{
    public static function logSave($aktivitas)
    {
        $attr = [
            'users_id' => auth()->user()->id,
            'aktivitas' => $aktivitas,
            'waktu' => now()
        ];

        $save = Logaktivitas::create($attr);
    }
}
