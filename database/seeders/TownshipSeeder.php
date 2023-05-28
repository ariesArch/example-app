<?php

namespace Database\Seeders;

use App\Models\Township;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $townships = [
        ['name' => 'Ahlone', 'slug' => 'ahlone', 'city_id' => 1],
        ['name' => 'Bahan', 'slug' => 'bahan', 'city_id' => 1],
        ['name' => 'Botataung', 'slug' => 'botataung', 'city_id' => 1],
    ];
    public function run(): void
    {
        foreach ($this->townships as $township) {
            Township::create($township);
        }
    }
}
