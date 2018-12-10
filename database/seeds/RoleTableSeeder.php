<?php

use Illuminate\Database\Seeder;
use App\marketing\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'แอดมิน'],
            ['name' => 'หัวหน้าฝ่ายการตลาด'],
            ['name' => 'พนักงานฝ่ายการตลาด']
        ];

        Role::insert($data);
    }
}
