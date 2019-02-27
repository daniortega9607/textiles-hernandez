<?php

namespace App\Http\Controllers;

use App\Stock;
use App\StockHistory;
use App\SalePayment;
use Illuminate\Http\Request;

class SalePaymentController extends Controller
{
    public function store(Request $request)
    {
        $item = SalePayment::create($request->only([
            'sale_id','amount_mxn','amount_usd'
        ]));

        $sale = $item->sale;
        $sale->balance = $sale->currency == 1 ? $sale->balance-$item->amount_mxn:$sale->balance-$item->amount_usd;
        if($sale->total == 0) $sale->balance = 0;
        if($sale->balance < 0) {
            $sale->status = 2;
            $sale->balance = 0;
        }
        $sale->save();

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Payment Created!' : 'Error Creating Payment'
        ]);
    }

    public function destroy(SalePayment $salePayment)
    {
        $status = $salePayment->delete();

        $sale = $salePayment->sale;
        $sale->balance = $sale->currency == 1 ? $sale->balance+$salePayment->amount_mxn:$sale->balance+$salePayment->amount_usd;
        if($sale->total == 0) $sale->balance = 0;
        if($sale->balance > 0) {
            $sale->status = 1;
        }
        $sale->save();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Payment Deleted!' : 'Error Deleting Payment'
        ]);
    }
}
