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
                "img" => "doesn't have a photo"
            ],
            [
                "name" => "Suchat  Aimaem",
                "detail" => "Champoin of UFC 5 years",
                "img" => "doesn't have a photo"
            ],
            [
                "name" => "SomChai  Khemkeang",
                "detail" => "Top 10 Knockout in our stadium",
                "img" => "doesn't have a photo"
            ],
        ];

        Trainer::insert($data);
    }
}
