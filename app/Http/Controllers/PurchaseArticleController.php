<?php

namespace App\Http\Controllers;

use App\Stock;
use App\StockHistory;
use App\PurchaseArticle;
use Illuminate\Http\Request;

class PurchaseArticleController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only([
            'purchase_id','product_id','description','roll_quantity','quantity','price'
        ]);
        $data['total'] = $data['quantity'] * $data['price'];
        $item = PurchaseArticle::create($data);

        if (!is_null($item->product_id) && $request->update_stock) {
            $stock = Stock::where('office_id',$item->purchase->office_id)->where('product_id',$item->product_id)->get();
            if (count($stock) > 0) {
                StockHistory::create([
                    'stock_id' => $stock[0]->id,
                    'purchase_id' => $item->purchase_id,
                    'roll_quantity' => $item->roll_quantity,
                    'prev_stock' => $stock[0]->stock,
                    'current_stock' => $stock[0]->stock + $item->quantity,
                    'user_id' => $request->user()->id
                ]);
                $stock[0]->update([
                    'stock' => $stock[0]->stock + $item->quantity
                ]);
            }
        }
        $item->purchase->update([
            'status' => 1,
            'balance' => $item->purchase->balance + $item->total,
            'total' => $item->purchase->articles->sum('total')
        ]);

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Article Created!' : 'Error Creating Article'
        ]);
    }

    public function destroy(PurchaseArticle $purchaseArticle)
    {
        $status = $purchaseArticle->delete();
        
        $purchaseStatus = $purchaseArticle->purchase->status;
        $balance = $purchaseArticle->purchase->balance - $purchaseArticle->total;
        if ($balance <= 0 && $purchaseStatus == 1) {
            $purchaseStatus = 2;
        }
        $purchaseArticle->purchase->update([
            'status' => $purchaseStatus,
            'balance' => $balance,
            'total' => $purchaseArticle->purchase->articles->sum('total')
        ]);
        if (!is_null($purchaseArticle->product_id)) {
            $stock = Stock::where('office_id',$purchaseArticle->purchase->office_id)->where('product_id',$purchaseArticle->product_id)->get();
            if (count($stock) > 0) {
                StockHistory::create([
                    'stock_id' => $stock[0]->id,
                    'purchase_id' => $purchaseArticle->purchase_id,
                    'prev_stock' => $stock[0]->stock,
                    'current_stock' => $stock[0]->stock - $purchaseArticle->quantity,
                    'user_id' => $request->user()->id
                ]);
                $stock[0]->update([
                    'stock' => $stock[0]->stock - $purchaseArticle->quantity
                ]);
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Article Deleted!' : 'Error Deleting Article'
        ]);
    }
}
