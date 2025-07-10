<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Area;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['name' => 'Engenharia Elétrica', 'area' => 'Engenharia'],
            ['name' => 'Arquitetura e Urbanismo', 'area' => 'Arquitetura'],
            ['name' => 'Emgenharia de Software', 'area' => 'Tecnologia da Informação'],
            ['name' => 'Direito', 'area' => 'Direito'],
        ];

        foreach ($courses as $data) {
            $area = Area::where('name', $data['area'])->first();
            if ($area) {
                Course::create([
                    'name' => $data['name'],
                    'area_id' => $area->id,
                ]);
            }
        }
    }
}
