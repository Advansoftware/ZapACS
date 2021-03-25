<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Verificado extends Seeder
{
    static $status = [
        'OK',
        'N TEM',
        'VERIFICAR',
        'INCORRETO'
    ];
    public function run()
    {
        foreach (self::$status as $statu) {
                DB::table('verificados')->insert([
                    'status' => $statu,
                ]);
        }
    }
}
