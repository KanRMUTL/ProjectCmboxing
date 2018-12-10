<?php

use Illuminate\Database\Seeder;
use App\marketing\GuideCommission;
class GuideCommissionTableSeeder extends Seeder
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
               'commission' => 200,
               'ticket_id' => 1
            ],
            [
               'commission' => 500,
               'ticket_id' => 2
            ],
            [
               'commission' => 800,
               'ticket_id' => 3
            ],
            
         ];
 
         GuideCommission::insert($data);
    }
}
