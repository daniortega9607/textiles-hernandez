<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'office_id','supplier_id','currency','balance','total','status','user_id'
    ];
    
    public function office()
    {
        return $this->belongsTo('App\Office')->withTrashed();
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    
    public function articles()
    {
        return $this->hasMany('App\PurchaseArticle');
    }

    public function payments()
    {
        return $this->hasMany('App\PurchasePayment');
    }
}
