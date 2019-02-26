<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'firstname' => 'Admin',
                'lastname' => 'CMBoxing',
                'username' => 'Admin',
                'email' => 'admin@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'password' => bcrypt('1234'),
                'role' => 1,
            ],
            [
                'id' => 2,
                'firstname' => 'หัวหน้าโซน A',
                'lastname' => 'CMBoxing',
                'username' => 'headA',
                'email' => 'headA@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'password' => bcrypt('1234'),
                'role' => 2,
            ],
            [
                'id' => 3,
                'firstname' => 'หัวหน้าโซน B',
                'lastname' => 'CMBoxing',
                'username' => 'headB',
                'email' => 'headB@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'password' => bcrypt('1234'),
                'role' => 2,
            ],
            [
                'id' => 4,
                'firstname' => 'พนักงานโซน A',
                'lastname' => 'CMBoxing',
                'username' => 'empA',
                'email' => 'empA@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'password' => bcrypt('1234'),
                'role' => 3,
            ],
            [
                'id' => 5,
                'firstname' => 'พนักงานโซน B',
                'lastname' => 'CMBoxing',
                'username' => 'empB',
                'email' => 'empB@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'password' => bcrypt('1234'),
                'role' => 3,
            ],
            [
                'id' => 6,
                'firstname' => 'หัวหน้าโซน C',
                'lastname' => 'CMBoxing',
                'username' => 'headC',
                'email' => 'headC@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'password' => bcrypt('1234'),
                'role' => 2,
            ],
            [
                'id' => 7,
                'firstname' => 'พนักงานโซน C',
                'lastname' => 'CMBoxing',
                'username' => 'empC',
                'email' => 'empC@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'password' => bcrypt('1234'),
                'role' => 3,
            ],
        ];

        User::insert($data);
    }
}
