<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class PediatriaParametroSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pediatria_parametro')->insert([
            ['id' => 1, 'codigo' => 'PESO',  'nombre' => 'Peso'],
            ['id' => 2, 'codigo' => 'TALLA', 'nombre' => 'Talla'],
            ['id' => 3, 'codigo' => 'IMC',   'nombre' => 'IMC'],
        ]);
    }
}