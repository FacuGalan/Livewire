<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Iva;

class IvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ivas = [
            [
                'nombre' => 'Exento',
                'tasa' => 0.00,
            ],
            [
                'nombre' => 'IVA Reducido',
                'tasa' => 10.50,
            ],
            [
                'nombre' => 'IVA General',
                'tasa' => 21.00,
            ],
        ];

        foreach ($ivas as $iva) {
            Iva::create($iva);
        }
    }
}