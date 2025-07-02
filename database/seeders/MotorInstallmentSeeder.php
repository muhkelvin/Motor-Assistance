<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Motor;
use App\Models\MotorInstallment;

class MotorInstallmentSeeder extends Seeder
{
    public function run(): void
    {
        $installmentSets = [
            [ // set 1
                ['dp' => 2000000, 'tenor' => 11, 'cicilan' => 2100000],
                ['dp' => 2500000, 'tenor' => 17, 'cicilan' => 1460000],
                ['dp' => 1100000, 'tenor' => 23, 'cicilan' => 1160000],
            ],
        ];

        $motors = Motor::all();

        foreach ($motors as $index => $motor) {
            // Rotasi pilihan set (biar nggak semua motor sama)
            $set = $installmentSets[$index % count($installmentSets)];

            foreach ($set as $installment) {
                MotorInstallment::create([
                    'motor_id' => $motor->id,
                    'down_payment' => $installment['dp'],
                    'tenor_months' => $installment['tenor'],
                    'installment_amount' => $installment['cicilan'],
                ]);
            }
        }
    }
}
