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
            ]
        ];

        Course::insert($data);

    }
}
