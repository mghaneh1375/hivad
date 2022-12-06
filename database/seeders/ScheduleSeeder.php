<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = ['sat', 'sun', 'mon', 'tue', 'wed', 'thr', 'fri'];

        foreach($days as $day) {
            Schedule::firstOrCreate(
                [
                    'day' => $day,
                ], 
                [
                    'day' => $day,
                    'is_open' => true,
                    'start' => '09:00',
                    'end' => '21:00',
                ]
            );
        }
        
    }
}
