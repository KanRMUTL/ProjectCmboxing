<?php

use Illuminate\Database\Seeder;
use App\marketing\Zone;

class ZoneTableSeeder extends Seeder
{
   
    public function run()
    {
        $data = [
            [
                'name' => 'Office',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'name' => 'A',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'name' => 'B',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'name' => 'C',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ]
        ];

        Zone::insert($data);
    }
}
