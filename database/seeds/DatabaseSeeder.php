<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(EmployeesTableSeeder::class);
        $this->call(GuesthouseTableSeeder::class);
        $this->call(GuideCommissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TicketTableSeeder::class);
        $this->call(ZoneTableSeeder::class);
        
        // หลังได้ออกแบบ ER
        
        $this->call(CoursesTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(SeatTableSeeder::class);
        $this->call(TrainerTableSeeder::class);
        $this->call(WebDetailTableSeeder::class);

    }
}
