<?php

use Illuminate\Database\Seeder;
use App\marketing\Employee;
class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        $data=[
            [
                'user_id' => 1,
                'id_card' => '1745855562221',
                'zone_id' => 1
            ],
            [
                'user_id' => 2 ,
                'id_card' => '1745855562221',
                'zone_id' => 2
            ],
            [
                'user_id' => 3,
                'id_card' => '1745855562221',
                'zone_id' => 3
            ],
            [
                'user_id' => 4,
                'id_card' => '1745855562221',
                'zone_id' => 2
            ],
            [
                'user_id' => 5,
                'id_card' => '1745855562221',
                'zone_id' => 3
            ],
            [
                'user_id' => 6,
                'id_card' => '1745855562221',
                'zone_id' => 4
            ],
            [
                'user_id' => 7,
                'id_card' => '1745855562221',
                'zone_id' => 4
            ],
        ];
        Employee::insert($data);
    }
}
