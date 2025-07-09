<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;
use App\Models\Address;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        $addresses = [
            ['state' => 'SP', 'city' => 'São Paulo', 'neighborhood' => 'Centro', 'street' => 'Av. Paulista', 'number' => '1000'],
            ['state' => 'RJ', 'city' => 'Rio de Janeiro', 'neighborhood' => 'Botafogo', 'street' => 'Rua São Clemente', 'number' => '500'],
        ];

        foreach ($addresses as $data) {
            $address = Address::create($data);

            Institution::create([
                'name' => 'Instituição em ' . $data['city'],
                'address_id' => $address->id,
            ]);
        }
    }
}