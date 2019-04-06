<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";
    protected $fillable = ['total', 'created_at', 'user_id'];
    public $timestamps = false;

    public function saleDetail()
    {
        return $this->hasMany('App\pos\SaleDetail', 'foreign_key', 'local_key');
    }
}

