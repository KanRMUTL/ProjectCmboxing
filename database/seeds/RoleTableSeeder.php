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
            ['id' => 1, 'name' => 'แอดมิน'],
            ['id' => 2, 'name' => 'หัวหน้าฝ่ายการตลาด'],
            ['id' => 3, 'name' => 'พนักงานฝ่ายการตลาด']
        ];

        Role::insert($data);
    }
}
