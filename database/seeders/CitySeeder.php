<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $cities = [
        ['name' => 'Yangon', 'slug' => 'yangon'],
        ['name' => 'Mandalay', 'slug' => 'mandalay'],
        ['name' => 'Monywa', 'slug' => 'monywa'],
    ];
    public function run(): void
    {
        foreach ($this->cities as $city) {
            City::create($city);
        }
    }
}
