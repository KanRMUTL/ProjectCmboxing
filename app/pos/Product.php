<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'barcode', 'unit'];
    public $timestamps = false;

    public function comments()
    {
        return $this->hasMany('App\pos\SaleDetail');
    }
}
