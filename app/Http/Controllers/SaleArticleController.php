<?php

namespace App\Http\Controllers;

use Auth;
use App\Stock;
use App\StockHistory;
use App\SaleArticle;
use Illuminate\Http\Request;

class SaleArticleController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only([
            'sale_id','product_id','description','quantity','price','revenue','commission'
        ]);
        $data['total'] = $data['quantity'] * $data['price'];
        $item = SaleArticle::create($data);

        if (!is_null($item->product_id) && $request->update_stock) {
            $stock = Stock::where('office_id',$item->sale->office_id)->where('product_id',$item->product_id)->get();
            if (count($stock) > 0) {
                StockHistory::create([
                    'stock_id' => $stock[0]->id,
                    'sale_id' => $item->sale_id,
                    'prev_stock' => $stock[0]->stock,
                    'current_stock' => $stock[0]->stock - $item->quantity,
                    'user_id' => $request->user()->id
                ]);
                $stock[0]->update([
                    'stock' => $stock[0]->stock - $item->quantity
                ]);
            }
        }
        $item->sale->update([
            'status' => 1,
            'balance' => $item->sale->balance + $item->total,
            'total' => $item->sale->articles->sum('total'),
            'revenue' => $item->sale->articles->sum('revenue'),
            'commission' => $item->sale->articles->sum('commission')
        ]);

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Article Created!' : 'Error Creating Article'
        ]);
    }

    public function destroy(SaleArticle $saleArticle)
    {
        $saleArticle->cancelled_by = 1;//Auth::user()->id;
        $saleArticle->save();

        $status = $saleArticle->delete();
        
        $saleStatus = $saleArticle->sale->status;
        $balance = $saleArticle->sale->balance - $saleArticle->total;
        if ($balance <= 0 && $saleStatus == 1) {
            $saleStatus = 2;
        }
        $saleArticle->sale->update([
            'status' => $saleStatus,
            'balance' => $balance,
            'total' => $saleArticle->sale->articles->sum('total'),
            'revenue' => $saleArticle->sale->articles->sum('revenue'),
            'commission' => $saleArticle->sale->articles->sum('commission')
        ]);
        if (!is_null($saleArticle->product_id)) {
            $stock = Stock::where('office_id',$saleArticle->sale->office_id)->where('product_id',$saleArticle->product_id)->get();
            if (count($stock) > 0) {
                StockHistory::create([
                    'stock_id' => $stock[0]->id,
                    'sale_id' => $saleArticle->sale_id,
                    'prev_stock' => $stock[0]->stock,
                    'current_stock' => $stock[0]->stock + $saleArticle->quantity,
                    'user_id' => $request->user()->id
                ]);
                $stock[0]->update([
                    'stock' => $stock[0]->stock + $saleArticle->quantity
                ]);
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Article Deleted!' : 'Error Deleting Article'
        ]);
    }
}
