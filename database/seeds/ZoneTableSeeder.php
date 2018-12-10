<?php

use Illuminate\Database\Seeder;
use App\marketing\Zone;
class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Office'],
            ['name' => 'A'],
            ['name' => 'B'],
            ['name' => 'C']
        ];

        Zone::insert($data);
    }
}
