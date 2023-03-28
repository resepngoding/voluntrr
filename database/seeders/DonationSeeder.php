<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('donations')->insert([
            [
                'user_id' => 2,
                'date' => now(),
                'donation_category' => 'Wakaf',
                'is_money' => true,
                'account' => 1,
                'money' => 500000,
                'goods' => null,
                'goods_qty' => null,
                'description' => 'test',
                'image' => 'null',
                'dataentry_id' => '2',
                'dataentry_name' => 'Fulan',
                'team' => '',
            ],
            [
                'user_id' => '2',
                'date' => now(),
                'donation_category' => 'Wakaf',
                'is_money' => false,
                'account' => 2,
                'money' => null,
                'goods' => 'Al Quran',
                'goods_qty' => '50',
                'description' => 'test',
                'image' => 'null',
                'dataentry_id' => '2',
                'dataentry_name' => 'Fulan',
                'team' => '',
            ],
            [
                'user_id' => '2',
                'date' => now(),
                'donation_category' => 'Infak / Sedekah',
                'is_money' => true,
                'account' => 2,
                'money' => 1000000,
                'goods' => null,
                'goods_qty' => null,
                'description' => 'test3',
                'image' => 'null',
                'dataentry_id' => '2',
                'dataentry_name' => 'Fulan',
                'team' => '',
            ],

        ]);
    }
}
