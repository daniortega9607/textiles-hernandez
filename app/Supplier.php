<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','address','phone','mobilephone','email','comments'
    ];
    
    public function purchases(){
        return $this->hasMany('App\Purchase');
    }

    public function balance()
    {
        return $this->hasOne('App\Purchase')->selectRaw('supplier_id,SUM(balance) as total')->groupBy('supplier_id');
    }
}
