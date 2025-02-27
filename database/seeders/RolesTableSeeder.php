<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Insert roles data
          DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'business_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'sub admin',
                'business_id' => 1,
                'created_at' => '2025-01-07 07:44:39',
                'updated_at' => '2025-01-07 07:44:39',
            ],
            [
                'id' => 3,
                'name' => 'lead tracker',
                'business_id' => 1,
                'created_at' => '2025-01-10 19:41:04',
                'updated_at' => '2025-01-10 19:41:04',
            ],
        ]);

        // Insert role_user data
        DB::table('role_user')->insert([
            [
                'id' => 1,
                'role_id' => 1,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'role_id' => 2,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
    }
}
