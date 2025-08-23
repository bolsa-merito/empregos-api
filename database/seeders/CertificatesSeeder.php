<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certificate::create([
            'student_id' => 1,
            'institution' => 'Senai',
            'course_name' => 'Mecatronica',
            'course_load' => 'Noturno',
        ]);
    }
}
