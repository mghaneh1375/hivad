<?php

namespace Database\Seeders;

use App\models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::create([
            "about" => "این متن تستی درباره ما است."
        ]);
    }
}
