<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Event::create(
                [
                    'event_name'=>"Event".$i,
                    'date_start'=>"2024-10-01 14:19:21",
                    'date_end'=>"2024-10-03 14:19:21",
                    'type_event'=>1,
                    'discount'=>10,
                    'slug'=>"event-".$i,
                    'status'=>1
                ]
            );
        }
    }
}
