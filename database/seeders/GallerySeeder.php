<?php

namespace Database\Seeders;

use App\models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         for($i = 1; $i < 7; $i++) {
            Gallery::create([
                "image" => "service" . $i . '.jpg',
                "alt" => "sample" . $i,
                "title" => "title" . $i,
                "tags" => "#tag" . $i,
                "description" => "desc" . $i,
                "priority" => $i,
                "is_imp" => true,
                "cat_id" => ((int)($i / 3)) + 1
            ]);
        }
    }
}
