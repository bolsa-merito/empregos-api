<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AreaSeeder::class,
            CourseSeeder::class,
            InstitutionSeeder::class,
        ]);

        // Se você tiver outros seeders, pode chamá-los aqui também
        // $this->call(ProductSeeder::class);
    }
}

// para rodar os seeders:     php artisan db:seed