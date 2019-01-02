<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ZoneTableSeeder::class);
        $this->call(GuideCommissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TicketTableSeeder::class);
        $this->call(GuesthouseTableSeeder::class);
        $this->call(SaleTypeTableSeeder::class);
    }
}
