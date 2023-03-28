<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->insert([
            [
                'name' => 'CASH',
                'account_number' => '123456789',
                'is_active' => 'Y'
            ],
            [
                'name' => 'BCA',
                'account_number' => '421313',
                'is_active' => 'Y'
            ],
            [
                'name' => 'BSI',
                'account_number' => '2432453',
                'is_active' => 'Y'
            ],

        ]);
    }
}
