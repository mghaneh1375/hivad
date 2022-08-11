<?php

namespace Database\Seeders;

use App\models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         for($i = 1; $i < 7; $i++) {
            News::create([
                "image" => "service" . $i,
                "alt" => "sample" . $i,
                "title" => "title" . $i,
                "digest" => "digest" . $i,
                "tags" => "#tag" . $i,
                "description" => "desc" . $i,
                "priority" => $i,
                "is_imp" => true
            ]);
        }
    }
}
