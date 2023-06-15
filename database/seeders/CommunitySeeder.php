<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Shopping', 'slug' => 'shopping','community_category_id'=>1]
        ];
        foreach ($data as $result) {
            Community::create($result);
        }
    }
}
