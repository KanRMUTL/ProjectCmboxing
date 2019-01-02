<?php

use Illuminate\Database\Seeder;
use App\marketing\SaleType;
class SaleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'ปกติ'],
            ['id' => 2, 'name' => 'ขายผ่านไกด์'],
            ['id' => 3, 'name' => 'หน้าออฟฟิศ']
        ];

        SaleType::insert($data);
    }
}
