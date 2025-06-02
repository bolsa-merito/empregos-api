<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        $institutions = [
            ['name' => 'Universidade Federal do Rio de Janeiro', 'city' => 'Rio de Janeiro', 'state' => 'RJ'],
            ['name' => 'Universidade de São Paulo', 'city' => 'São Paulo', 'state' => 'SP'],
            ['name' => 'Instituto Federal do Ceará', 'city' => 'Fortaleza', 'state' => 'CE'],
            ['name' => 'Universidade Federal de Minas Gerais', 'city' => 'Belo Horizonte', 'state' => 'MG'],
        ];

        foreach ($institutions as $institution) {
            Institution::create($institution);
        }
    }
}