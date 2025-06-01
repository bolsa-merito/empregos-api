<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['name' => 'Engenharia de Software', 'area' => 'Tecnologia'],
            ['name' => 'Administração', 'area' => 'Negócios'],
            ['name' => 'Direito', 'area' => 'Humanas'],
            ['name' => 'Ciência da Computação', 'area' => 'Tecnologia'],
            ['name' => 'Engenharia Civil', 'area' => 'Engenharia'],
            ['name' => 'Design Gráfico', 'area' => 'Artes'],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
