<?php

use Illuminate\Database\Seeder;
use App\pos\Product;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'barcode' => '80378123456',
                'name' => 'กางเกงนักมวย',
                'img' => '1.jpg',
                'price' => 600,
                'unit' => 'ตัว',
                'amount' => 104,
            ],
            [
                'barcode' => '80378123457',
                'name' => 'เสื้อยืดลายมวยไทย',
                'img' => '2.jpg',
                'price' => 300,
                'unit' => 'ผืน',
                'amount' => 300,
            ],
            [
                'barcode' => '80378123456',
                'name' => 'นวมชกมวย',
                'img' => '3.jpg',
                'price' => 600,
                'unit' => 'คู่',
                'amount' => 133,
            ],
        ];

        Product::insert($data);
    }
}
