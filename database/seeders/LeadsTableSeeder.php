<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['new', 'contacted', 'converted'];

        for ($i = 1; $i <= 16; $i++) {
            $businessName = 'Business' . $i; // Generate business name
            $email = Str::slug($businessName, '.') . '@example.com'; // Generate email matching the business name

            DB::table('leads')->insert([
                'business_id' => 2,
                'name' => $businessName,
                'email' => $email,
                'phone' => '123-456-78' . str_pad($i, 2, '0', STR_PAD_LEFT), // Unique phone number
                'status' => $statuses[array_rand($statuses)], // Randomly assign a status
                'message' => 'Proin gravida justo sit amet dolor condimentum pharetra. Integer euismod blandit lorem sed viverra.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
