<?php

use Illuminate\Database\Seeder;
use App\marketing\Zone;

class ZoneTableSeeder extends Seeder
{
   
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Office',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'id'=> 2,
                'name' => 'A1',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'id'=> 3,
                'name' => 'A2',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'id'=> 4,
                'name' => 'A3',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'id'=> 5,
                'name' => 'B1',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [   
                'id'=> 6,
                'name' => 'B2',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'id'=> 7,
                'name' => 'B3',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'id'=> 8,
                'name' => 'B4',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'id'=> 9,
                'name' => 'D1',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'id'=> 10,
                'name' => 'D2',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ],
            [
                'id'=> 11,
                'name' => 'D3',
                'latitude' => '18°19\'03.6"N',
                'longitude' => '+99°23\'48.0"E'
            ]
        ];

        Zone::insert($data);
    }
}
