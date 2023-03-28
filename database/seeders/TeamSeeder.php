<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            [
                'name' => 'Mawar',
                'leader_name' => 'fulan',
            ],
            [
                'name' => 'Melati',
                'leader_name' => 'fulanah',
            ],
            [
                'name' => 'Tulip',
                'leader_name' => 'kabayan',
            ],
            [
                'name' => 'Babadotan',
                'leader_name' => 'iteung',
            ],

        ]);
    }
}
