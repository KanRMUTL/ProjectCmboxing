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
               'img' => 'ticket_grandstand.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Ringside',
                'price' => 1000,
                'img' => 'ticket_ringside.jpg'
            ],
            [
                'id' => 3,
                'name' => 'VIP',
                'price' => 1500,
                'img' => 'ticket_vip.jpg'
           ],
        ];

        Ticket::insert($data);
    }
}
