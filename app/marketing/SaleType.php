<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class SaleType extends Model
{
    protected $table = "sale_type";
    protected $fillable =[
        'name', 'id'
    ];
}
