<?php

use Illuminate\Database\Seeder;
use App\shopping\Seat;

class SeatTableSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        
        for($group = 1; $group <= 6; $group++)
        {
            if($group == 1){
                for($id = 1; $id <= 80; $id++)
                {
                    $data[] = [
                        'name' => 'V'.$id,
                        'ticket_id' => 3,
                        'group' => $group
                    ];
                }
            }

            if($group == 2){
                for($id = 1; $id <= 30; $id++)
                {
                    $data[] = [
                        'name' => 'R'.$id,
                        'ticket_id' => 2,
                        'group' => $group
                    ];
                }
            }

            if($group == 3){
                for($id = 31; $id <= 60; $id++)
                {
                    $data[] = [
                        'name' => 'R'.$id,
                        'ticket_id' => 2,
                        'group' => $group
                    ];
                }
            }

            if($group == 4){
                for($id = 61; $id <= 105; $id++)
                {
                    $data[] = [
                        'name' => 'R'.$id,
                        'ticket_id' => 2,
                        'group' => $group
                    ];
                }
            }

            if($group == 5){
                for($id = 106; $id <= 150; $id++)
                {
                    $data[] = [
                        'name' => 'R'.$id,
                        'ticket_id' => 2,
                        'group' => $group
                    ];
                }
            }

            if($group == 6){
                for($id = 151; $id <= 180; $id++)
                {
                    $data[] = [
                        'name' => 'R'.$id,
                        'ticket_id' => 2,
                        'group' => $group
                    ];
                }
            }
        }

        Seat::insert($data);
    }
}
