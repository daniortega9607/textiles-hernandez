<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleArticle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sale_id','product_id','description','quantity','price','total','cancelled_by','revenue','commission'
    ];

    public function sale()
    {
        return $this->belongsTo('App\Sale')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'cancelled_by')->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo('App\Product')->withTrashed();
    }
}
