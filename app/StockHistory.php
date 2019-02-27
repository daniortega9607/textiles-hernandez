<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable = [
        'stock_id','sale_id','purchase_id','roll_quantity','prev_stock','current_stock','user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
}
