<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'First Page', 'slug' => 'first-page','community_category_id'=>1,'community_id'=>1]
        ];
        foreach ($data as $result) {
            Page::create($result);
        }
    }
}
