<?php

use Illuminate\Database\Seeder;
use App\marketing\Ticket;
class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
           [
               'id' => 1,
               'name' => 'Grandstand',
               'price' => 600
           ],
           [
               'id' => 2,
               'name' => 'Ringside',
               'price' => 1000
           ],
           [
                'id' => 3,
                'name' => 'Grandstand',
                'price' => 1500
           ],
        ];

        Ticket::insert($data);
    }
}
