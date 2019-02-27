<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','address','phone','mobilephone','email','credit_days','comments'
    ];
    
    public function sales(){
        return $this->hasMany('App\Sale');
    }

    public function balance()
    {
        return $this->hasOne('App\Sale')->selectRaw('customer_id,SUM(balance) as total')->groupBy('customer_id');
    }
}
