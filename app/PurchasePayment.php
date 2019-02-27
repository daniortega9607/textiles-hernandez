<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasePayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'purchase_id','amount_mxn','amount_usd',
    ];

    public function purchase()
    {
        return $this->belongsTo('App\Purchase')->withTrashed();
    }
}
