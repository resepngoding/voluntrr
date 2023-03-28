<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Superadmin',
                'username' => 'superadmin',
                'email' => 'superadmin@superadmintea.com',
                'role' => 'superadmin',
                'image' => null,
                'team_id' => 2,
                'password' => bcrypt('$vbh4n4ll4h'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fulan',
                'username' => 'admin',
                'email' => 'fulan@example.com',
                'role' => 'admin',
                'image' => null,
                'team_id' => 1,
                'password' => bcrypt('$vbh4n4ll4h'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
