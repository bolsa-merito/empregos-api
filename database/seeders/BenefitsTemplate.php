<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BenefitsTemplate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Desativa a verificação de chaves estrangeiras
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpa a tabela antes de popular para evitar duplicatas
        DB::table('benefits_templates')->truncate();

        $benefits = [
            'Bolsa-auxílio',
            'Auxílio-transporte',
            'Vale-refeição',
            'Seguro de vida',
            'Assistência médica',
            'Assistência odontológica',
            'Flexibilidade de horário',
            'Plano de desenvolvimento e mentoria',
            'Oportunidade de efetivação',
            'Recesso remunerado',
            'Cesta de Natal',
            'Premiações'
        ];

        $data = [];

        foreach ($benefits as $benefit) {
            $data[] = [
                'name' => $benefit
            ];
        }

        DB::table('benefits_templates')->insert($data);
    }
}
