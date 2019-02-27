<?php

namespace App\Http\Controllers;

use App\Stock;
use App\StockHistory;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        return response()->json(Stock::with(['office','product'])->get(),200);
    }

    public function store(Request $request)
    {
        $stock = Stock::where('office_id',$request->office_id)->where('product_id',$request->product_id)->get();
        
        if (count($stock) > 0) {
            return response()->json([
                'status' => false,
                'data' => $stock[0],
                'message' => 'Stock already Created!'
            ], 400);
        }

        $item = Stock::create($request->only([
            'office_id','product_id','stock'
        ]));

        StockHistory::create([
            'stock_id' => $item->id,
            'roll_quantity' => $request->roll_quantity,
            'prev_stock' => 0,
            'current_stock' => $item->stock,
            'user_id' => $request->user()->id
        ]);

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Stock Created!' : 'Error Creating Stock'
        ]);
    }

    public function show(Stock $stock)
    {
        return response()->json(Stock::with(['office','product','stock_history.user'])->find($stock->id),200);         
    }

    public function update(Request $request, Stock $stock)
    {
        StockHistory::create([
            'stock_id' => $stock->id,
            'roll_quantity' => $request->roll_quantity,
            'prev_stock' => $stock->stock,
            'current_stock' => $request->stock,
            'user_id' => $request->user()->id
        ]);

        $status = $stock->update(
            $request->only(['stock'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Stock Updated!' : 'Error Updating Stock'
        ]);
    }

    public function destroy(Stock $stock)
    {
        $status = $stock->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Stock Deleted!' : 'Error Deleting Stock'
        ]);
    }
}
