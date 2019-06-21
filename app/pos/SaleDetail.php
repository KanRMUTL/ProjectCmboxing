<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $table = "sale_details";
    protected $fillable = ['amount', 'total', 'product_id', 'bill_id'];
    public $timestamps = false;

    public function bill()
    {
        return $this->belongsTo('App\pos\Bill');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\pos\Product');
    }
}
