<?php

namespace Database\Seeders;

use App\models\SlideBar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 6; $i++) {
            SlideBar::create([
                "image" => "slider" . $i . '.jpg',
                "alt" => "sample" . $i,
                "header" => "header" . $i,
                "description" => "desc" . $i,
                "priority" => $i
            ]);
        }
    }
}
