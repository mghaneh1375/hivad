<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\models\User::factory(10)->create();

        // \App\models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
          $this->call([
            SliderSeeder::class,
            CategorySeeder::class,
            GallerySeeder::class,
            NewsSeeder::class,
            IntroduceSeeder::class,
            ConfigSeeder::class
        ]);
    }
}
