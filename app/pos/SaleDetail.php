<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $table = "sale_details";
    protected $fillable = ['amount', 'total', 'product_id', 'sale_id'];
    public $timestamps = false;

    public function bill()
    {
        return $this->belongsTo('App\pos\Bill');
    }
}
