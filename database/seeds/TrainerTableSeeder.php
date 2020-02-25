<?php

use Illuminate\Database\Seeder;
use App\shopping\Trainer;

class TrainerTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "name" => "SomChai  Khemkeang",
                "detail" => "Champoin of Word 2018",
                "img" => "20190907_072433_Freddie-Roach-Boxing-Trainer.png"
            ],
            [
                "name" => "SomChai  Khemkeang",
                "detail" => "Top 10 Knockout in our stadium",
                "img" => "1.jpg"
            ],
        ];

        Trainer::insert($data);
    }
}
