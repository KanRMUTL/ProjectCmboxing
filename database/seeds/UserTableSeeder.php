<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin Admin',
                'username' => 'Admin',
                'email' => 'admin@localhost.com',
                'password' => bcrypt('1234'),
                'role_id' => 1,
                'zone_id' => 1
            ],
            [
                'name' => 'head A',
                'username' => 'headA',
                'email' => 'headA@localhost.com',
                'password' => bcrypt('1234'),
                'role_id' => 2,
                'zone_id' => 2
            ],
            [
                'name' => 'head B',
                'username' => 'headB',
                'email' => 'headB@localhost.com',
                'password' => bcrypt('1234'),
                'role_id' => 2,
                'zone_id' => 3
            ],
            [
                'name' => 'emp A',
                'username' => 'empA',
                'email' => 'empA@localhost.com',
                'password' => bcrypt('1234'),
                'role_id' => 3,
                'zone_id' => 2
            ],
            [
                'name' => 'emp B',
                'username' => 'empB',
                'email' => 'empB@localhost.com',
                'password' => bcrypt('1234'),
                'role_id' => 3,
                'zone_id' => 3
            ]
        ];

        User::insert($data);
    }
}
