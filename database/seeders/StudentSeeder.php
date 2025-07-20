<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'first_name' => 'João',
            'last_name' => 'Silva',
            'birth_date' => '2000-01-01',
            'looking_for_internship' => true,
            'description' => 'Estudante de Engenharia de Software',
            'contact_email' => 'joao@email.com',
            'phone_number' => '11999999999',
            'user_id' => 1,
        ]);
    }
}
