<?php

use Illuminate\Database\Seeder;
use App\shopping\Seat;

class SeatTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => "R1",
                'ticket_id' => 2
            ],
            [
                'name' => 'R2',
                'ticket_id' => 2
            ],
            [
                'name' => "R3",
                'ticket_id' => 2
            ],
            [
                'name' => 'R4',
                'ticket_id' => 2
            ],
            [
                'name' => "R5",
                'ticket_id' => 2
            ],
            [
                'name' => 'R6',
                'ticket_id' => 2
            ],
            [
                'name' => "V1",
                'ticket_id' => 3
            ],
            [
                'name' => 'V2',
                'ticket_id' => 3
            ],
            [
                'name' => "V3",
                'ticket_id' => 3
            ],
            [
                'name' => 'V4',
                'ticket_id' => 3
            ],
            [
                'name' => "V5",
                'ticket_id' => 3
            ],
            [
                'name' => 'V6',
                'ticket_id' => 3
            ],
        ];

        Seat::insert($data);
    }
}
