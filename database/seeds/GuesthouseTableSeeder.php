<?php

use Illuminate\Database\Seeder;
use App\marketing\Guesthouse;
class GuesthouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            [
                'name' => 'โรงแรมเมอร์เคียว',
                'zone_id' => 2
            ],
            [
                'name' => 'โรงแรมภูคำ',
                'zone_id' => 2
            ],
            [
                'name' => 'โรงแรมอัมรา',
                'zone_id' => 3
            ],
            [
                'name' => 'โฮมสเตย์ไนท์บาซาร์',
                'zone_id' => 3
            ],
            [
                'name' => 'โรงแรม Getzleep',
                'zone_id' => 4
            ],
            [
                'name' => 'แอทบ๊อคโฮเทล',
                'zone_id' => 4
            ]
        ];

        Guesthouse::insert($data);
    }
}
