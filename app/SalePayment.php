<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalePayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sale_id','amount_mxn','amount_usd',
    ];

    public function sale()
    {
        return $this->belongsTo('App\Sale')->withTrashed();
    }
}
