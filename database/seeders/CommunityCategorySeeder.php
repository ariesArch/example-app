<?php

namespace Database\Seeders;

use App\Models\CommunityCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunityCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name'=>'Shopping','slug'=>'shopping'],
            ['name'=>'Learning','slug'=>'learning']
        ];
        foreach($data as $result) {
            CommunityCategory::create($result);
        }
    }
}
