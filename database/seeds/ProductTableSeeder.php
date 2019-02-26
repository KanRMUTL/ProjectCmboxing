<?php

use Illuminate\Database\Seeder;
use App\pos\Product;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'barcode' => '803AZ123456',
                'name' => 'กางเกงนักมวย',
                'price' => 600,
                'unit' => 'ตัว',
                'amount' => 104,
            ],
            [
                'barcode' => '803AZ123457',
                'name' => 'เสื้อยืดลายมวยไทย',
                'price' => 300,
                'unit' => 'ผืน',
                'amount' => 300,
            ],
            [
                'barcode' => '803AZ123456',
                'name' => 'นวมชกมวย',
                'price' => 600,
                'unit' => 'อัน',
                'amount' => 133,
            ],
        ];

        Product::insert($data);
    }
}
