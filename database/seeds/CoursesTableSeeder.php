<?php

use Illuminate\Database\Seeder;
use App\shopping\Course;

class CoursesTableSeeder extends Seeder
{
   
    public function run()
    {
        $data =[
            [
               'name' => '1 Hour',
               'price' => 500,
               'detail' => 'Training 1 hour at chaing boxing stadium' 
            ],
            [
               'name' => '1 Week',
               'price' => 4000,
               'detail' => 'Training 1 week(2 hour 30 minutes in half day)' 
            ],
            [
               'name' => '1 Week',
               'price' => 5500,
               'detail' => 'Training 1 week (full day)' 
            ],
            [
               'name' => '1 Month',
               'price' => 10000,
               'detail' => 'Training 1 month (3 hour in half day) ' 
            ],
            [
               'name' => '1 Month',
               'price' => 15000,
               'detail' => 'Training 1 month (full day)' 
            ],
        ];

        Course::insert($data);

    }
}
