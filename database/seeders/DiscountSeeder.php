<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discount::create([
            'name' => 'Discount 1',
            'description' => 'Discount 1 description',
            'type' => 'percentage',
            'value' => 10,
            'status' => 'active',
            'expired_at' => now()->addDays(30),
        ]);

        Discount::create([
            'name' => 'Discount 2',
            'description' => 'Discount 2 description',
            'type' => 'percentage',
            'value' => 15,
            'status' => 'active',
            'expired_at' => now()->addDays(30),
        ]);

        Discount::create([
            'name' => 'Discount 3',
            'description' => 'Discount 3 description',
            'type' => 'percentage',
            'value' => 20,
            'status' => 'active',
            'expired_at' => now()->addDays(30),
        ]);

    }
}