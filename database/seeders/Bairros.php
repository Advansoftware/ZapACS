<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Bairros extends Seeder
{
    static $dados = [
        'CRUZ VERA',
        'SERRA DOS CUNHA',
        'FARIAS',
        'PRAINHA',
        'TEODOROS'
    ];
    public function run()
    {
        foreach (self::$dados as $bairro) {
            DB::table('bairros')->insert([
                'nome' => $bairro,
            ]);
    }
    }
}
