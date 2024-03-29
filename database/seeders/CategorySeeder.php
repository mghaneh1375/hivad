<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i = 1; $i <= 3; $i++) {
            Category::create([
                "image" => "service" . $i . '.jpg',
                "alt" => "sample" . $i,
                "title" => "title" . $i,
                "priority" => $i,
                "section" => "gallery"
            ]);
        }
    }
}
