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
                'firstname' => 'สุวนันท์',
                'lastname' => 'ไชยฉิมพลี',
                'username' => 'Admin',
                'email' => 'admin@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'img' => '20190503_144311_images.jpg',
                'password' => bcrypt('1234'),
                'role' => 1,
            ],
            [
                'id' => 2,
                'firstname' => 'สมศักดิ์',
                'lastname' => 'โชคดี',
                'username' => 'headA',
                'email' => 'headA@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'img' => 'profile(2).png',
                'password' => bcrypt('1234'),
                'role' => 2,
            ],
            [
                'id' => 3,
                'firstname' => 'อาทิตยา',
                'lastname' => 'คำมา',
                'username' => 'headB',
                'email' => 'headB@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'img' => 'profile(3).png',
                'password' => bcrypt('1234'),
                'role' => 2,
            ],
            [
                'id' => 4,
                'firstname' => 'ณัฐพงษ์',
                'lastname' => 'ไชยน้อย',
                'username' => 'อนุชา',
                'email' => 'empA@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'img' => 'profile(4).png',
                'password' => bcrypt('1234'),
                'role' => 3,
            ],
            [
                'id' => 5,
                'firstname' => 'เสธสิทธิ์',
                'lastname' => 'ศรีจันทร์',
                'username' => 'empB',
                'email' => 'empB@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'img' => 'profile(5).png',
                'password' => bcrypt('1234'),
                'role' => 3,
            ],
            [
                'id' => 6,
                'firstname' => 'เอกรินทร์',
                'lastname' => 'แก้วตา',
                'username' => 'headC',
                'email' => 'headC@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'img' => 'profile(6).png',
                'password' => bcrypt('1234'),
                'role' => 2,
            ],
            [
                'id' => 7,
                'firstname' => 'สมชาย',
                'lastname' => 'มิ่งมิตร',
                'username' => 'empC',
                'email' => 'empC@localhost.com',
                'phone_number' => '0841753818',
                'address' => '6/2 ม.5 ต.ช้างเผือก อ.เมือง จ.เชียงใหม่',
                'img' => 'profile(7).png',
                'password' => bcrypt('1234'),
                'role' => 3,
            ],
        ];

        User::insert($data);
    }
}
