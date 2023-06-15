<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AttributeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call([
            AdminSeeder::class,
            CitySeeder::class,
            TownshipSeeder::class,
            CommunityCategorySeeder::class,
            CommunitySeeder::class,
            PageSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            ProductSeeder::class,
            ProductAttributeValueSeeder::class,
            VariationSeeder::class
        ]);
    }
}
