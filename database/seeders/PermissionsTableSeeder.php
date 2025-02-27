<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert permissions data
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'view users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'view roles',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'invite users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'manage subscriptions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insert permission_role data
        DB::table('permission_role')->insert([
            [
                'id' => 1,
                'permission_id' => 1,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'permission_id' => 2,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'permission_id' => 3,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'permission_id' => 4,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Insert permission_plan data
        DB::table('permission_plan')->insert([
            [
                'id' => 1,
                'permission_id' => 1,
                'plan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'permission_id' => 2,
                'plan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'permission_id' => 3,
                'plan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'permission_id' => 4,
                'plan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
