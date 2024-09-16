<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'Basic Plan',
                'description' => 'A starter plan suitable for small teams and individuals.',
                'price' => 29.99,
                'currency' => 'USD',
                'duration' => 30, 
                'trial_duration' => 7, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Standard Plan',
                'description' => 'Best for growing businesses, with additional features and flexibility.',
                'price' => 59.99,
                'currency' => 'USD',
                'duration' => 30,
                'trial_duration' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium Plan',
                'description' => 'Full-featured plan with unlimited access and support for large teams.',
                'price' => 99.99,
                'currency' => 'USD',
                'duration' => 30,
                'trial_duration' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
