<?php

use Illuminate\Database\Seeder;
use App\marketing\Ticket;
class TicketTableSeeder extends Seeder
{
   
    public function run()
    {
        $data = [
           [
               'id' => 1,
               'name' => 'Grandstand',
               'price' => 600,
               'img' => 'do not have a photo'
            ],
            [
                'id' => 2,
                'name' => 'Ringside',
                'price' => 1000,
                'img' => 'do not have a photo'
            ],
            [
                'id' => 3,
                'name' => 'VIP',
                'price' => 1500,
                'img' => 'do not have a photo'
           ],
        ];

        Ticket::insert($data);
    }
}
