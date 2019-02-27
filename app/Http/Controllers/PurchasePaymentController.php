<?php

namespace App\Http\Controllers;

use App\Stock;
use App\StockHistory;
use App\PurchasePayment;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    public function store(Request $request)
    {
        $item = PurchasePayment::create($request->only([
            'purchase_id','amount_mxn','amount_usd'
        ]));

        $purchase = $item->purchase;
        $purchase->balance = $purchase->currency == 1 ? $purchase->balance-$item->amount_mxn:$purchase->balance-$item->amount_usd;
        if($purchase->total == 0) $purchase->balance = 0;
        if($purchase->balance < 0) {
            $purchase->status = 2;
            $purchase->balance = 0;
        }
        $purchase->save();

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Payment Created!' : 'Error Creating Payment'
        ]);
    }

    public function destroy(PurchasePayment $purchasePayment)
    {
        $status = $purchasePayment->delete();

        $purchase = $purchasePayment->purchase;
        $purchase->balance = $purchase->currency == 1 ? $purchase->balance+$purchasePayment->amount_mxn:$purchase->balance+$purchasePayment->amount_usd;
        if($purchase->total == 0) $purchase->balance = 0;
        if($purchase->balance > 0) {
            $purchase->status = 1;
        }
        $purchase->save();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Payment Deleted!' : 'Error Deleting Payment'
        ]);
    }
}
