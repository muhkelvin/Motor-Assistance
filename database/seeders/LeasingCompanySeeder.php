<?php

namespace Database\Seeders;

use App\Models\LeasingCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeasingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leasingCompanies = [
            [
                'name' => 'BAF (Bussan Auto Finance)',
                'interest_rate' => 12.5,
                'admin_fee' => 350000,
                'terms_conditions' => 'Syarat dan ketentuan BAF berlaku',
                'slug' => 'baf'
            ],
            [
                'name' => 'FIF (Federal International Finance)',
                'interest_rate' => 13.0,
                'admin_fee' => 300000,
                'terms_conditions' => 'Syarat dan ketentuan FIF berlaku',
                'slug' => 'fif'
            ],
            [
                'name' => 'WOM Finance',
                'interest_rate' => 12.8,
                'admin_fee' => 400000,
                'terms_conditions' => 'Syarat dan ketentuan WOM Finance berlaku',
                'slug' => 'wom'
            ],
            [
                'name' => 'Adira Finance',
                'interest_rate' => 13.5,
                'admin_fee' => 375000,
                'terms_conditions' => 'Syarat dan ketentuan Adira Finance berlaku',
                'slug' => 'af'
            ],
            [
                'name' => 'BULAN MOTOR',
                'interest_rate' => 11.0,
                'admin_fee' => 350000,
                'terms_conditions' => 'Syarat dan ketentuan MTF berlaku',
                'slug' => 'bulan'
            ]
        ];

        foreach ($leasingCompanies as $company) {
            LeasingCompany::create($company);
        }
    }
}
