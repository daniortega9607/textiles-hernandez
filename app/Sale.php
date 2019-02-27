<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'office_id','customer_id','currency','balance','total','revenue','commission','status','user_id'
    ];
    
    public function office()
    {
        return $this->belongsTo('App\Office')->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    
    public function articles()
    {
        return $this->hasMany('App\SaleArticle');
    }

    public function payments()
    {
        return $this->hasMany('App\SalePayment');
    }
}
