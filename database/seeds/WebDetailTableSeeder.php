<?php

use Illuminate\Database\Seeder;
use App\shopping\WebDetail;
class WebDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'id' => 1,
            'email' => 'cmboxingstadium@gmail.com',
            'phone' => '0815944151',
            'about' => 'Welcome to the Chiangmai boxing stadium. come and watch the official sport of Thailand. Muay Thai boxing has a long history in Thailand and at Chiangmai boxing stadium we show some of the best fights with top fighters from Bangkok that you will only see here. While in Chiangmai do not miss out on the opportunity to watch this famous sport in the best stadium in Chiangmai.',
            'facebook' => 'https://www.facebook.com/pg/Chiangmai-Boxing-Stadium-Offcial-306515443479981/about/?ref=page_internal',
            'line_token' => '4UYD1yo9Ahyu2ILWtprK3AQEUoo8Nv8TFyCTm3Ji2RU',
            'user_id' => 1
        ];

        WebDetail::insert($data);
    }
}
