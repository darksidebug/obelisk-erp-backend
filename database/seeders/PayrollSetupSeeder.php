<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PayrollSetting;

class PayrollSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = [
            [
                'abbrev' => 'PhilHealth',
                'name' => 'PhilHealth',
                'type' => 1,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'SSS',
                'name' => 'SSS',
                'type' => 1,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'GSIS',
                'name' => 'GSIS',
                'type' => 1,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'HDMF',
                'name' => 'HDMF',
                'type' => 1,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'HMO',
                'name' => 'HMO Share',
                'type' => 2,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'Tax',
                'name' => 'Withholding Tax',
                'type' => 3,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'Tardiness',
                'name' => 'Tardiness',
                'type' => 2,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'PA (Ded.)',
                'name' => 'Payroll Adjustment (Ded.)',
                'type' => 2,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'Other (Ded.)',
                'name' => 'Other Deduction',
                'type' => 4,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'Basic Pay',
                'name' => 'Basic Pay',
                'type' => 5,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0,
                'subject_for_tax' => 1
            ],
            [
                'abbrev' => 'Hourly Rate',
                'name' => 'Hourly Rate',
                'type' => 5,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'RD OT',
                'name' => 'Rest Day OT',
                'type' => 6,
                'is_fixed' => 1,
                'amount' => 30,
                'is_percentage' => 1,
                'subject_for_tax' => 1
            ],
            [
                'abbrev' => 'Holiday OT',
                'name' => 'Holiday OT',
                'type' => 6,
                'is_fixed' => 1,
                'amount' => 30,
                'is_percentage' => 1,
                'subject_for_tax' => 1
            ],
            [
                'abbrev' => '13th Month',
                'name' => '13th Month Pay',
                'type' => 6,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'Bonus',
                'name' => 'Bonus',
                'type' => 6,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'Allowance',
                'name' => 'Allowance',
                'type' => 6,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'De minimis',
                'name' => 'De minimis',
                'type' => 6,
                'is_fixed' => 1,
                'amount' => 2500,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'Night Diff.',
                'name' => 'Night Differential',
                'type' => 6,
                'is_fixed' => 1,
                'amount' => 10,
                'is_percentage' => 1,
                'subject_for_tax' => 1
            ],
            [
                'abbrev' => 'Hazard Pay',
                'name' => 'Hazard Pay',
                'type' => 6,
                'is_fixed' => 1,
                'amount' => 1000,
                'is_percentage' => 0,
                'subject_for_tax' => 0
            ],
            [
                'abbrev' => 'PA (Earn.)',
                'name' => 'Payroll Adjustment (Earnings)',
                'type' => 6,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 1
            ],
            [
                'abbrev' => 'Other (Earn.)',
                'name' => 'Other Earnings',
                'type' => 2,
                'is_fixed' => 0,
                'amount' => 0,
                'is_percentage' => 0,
                'subject_for_tax' => 1
            ]
        ];

        PayrollSetting::insert($seeder);
    }
}
