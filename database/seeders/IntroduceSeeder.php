<?php

namespace Database\Seeders;

use App\Models\Introduce;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntroduceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 7; $i++) {
            Introduce::create([
                "image" => "service" . $i . '.jpg',
                "alt" => "sample" . $i,
                "priority" => $i
            ]);
        }
    }
}
