<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseArticle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'purchase_id','product_id','description','roll_quantity','quantity','price','total'
    ];

    public function purchase()
    {
        return $this->belongsTo('App\Purchase')->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo('App\Product')->withTrashed();
    }
}
