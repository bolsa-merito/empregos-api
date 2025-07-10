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
            ['state' => 'SC', 'city' => 'Mafra', 'neighborhood' => 'Jardim do Moinho', 'street' => 'Av. Nereu Ramos', 'number' => '1071'],
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