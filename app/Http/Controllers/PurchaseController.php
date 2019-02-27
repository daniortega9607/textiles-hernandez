<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Supplier;
use App\Purchase;
use App\StockHistory;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $query = Purchase::selectRaw('purchases.*, IF(currency=1,"MXN","USD") as currency')->with(['office','supplier','user']);
        $ids = Purchase::select('purchases.id');
        $query->leftJoin('suppliers','suppliers.id','=','purchases.supplier_id');
        $ids->leftJoin('suppliers','suppliers.id','=','purchases.supplier_id');
        $query->leftJoin('users','users.id','=','purchases.user_id');
        $ids->leftJoin('users','users.id','=','purchases.user_id');
        if (isset($request->search)) {
            $query->where('suppliers.name','like','%'.$request->search.'%')
            ->orWhere('users.name','like','%'.$request->search.'%');
            $ids->where('suppliers.name','like','%'.$request->search.'%')
            ->orWhere('users.name','like','%'.$request->search.'%');
        }
        $query->orderBy('created_at','desc');
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
            $totals = collect([
                'totals' => Purchase::selectRaw('
                    SUM(balance) as balance, SUM(total) as total, IF(currency=1,"MXN","USD") as currency
                ')->whereIn('id',$ids->get())->groupBy('currency')->get()
            ]);
            $data = $totals->merge($query->paginate($paginate));
            return response()->json($data,200);
        }
        return response()->json($query->get(),200);
    }

    public function store(Request $request)
    {
        $purchase = $request->only([
            'office_id','supplier_id','currency','balance','total','status'
        ]);
        $purchase['user_id'] = $request->user()->id;
        $item = Purchase::create($purchase);

        if(isset($request->supplier) && is_null($request->supplier_id) 
            && !is_null($request->supplier['name'])){
            $supplier = Supplier::create(['name' => $request->supplier['name']]);
            $item->supplier_id = $supplier->id;   
            $item->save(); 
        }

        $articles = $request->articles;
        if(count($articles) > 0) {
            $item->articles()->createMany($articles);
            if(isset($request->update_stock) && $request->update_stock){
                foreach ($articles as $key => $article) {
                    if (isset($article['product_id']) && !is_null($article['product_id'])) {
                        $stock = Stock::where('office_id',$item->office_id)->where('product_id',$article['product_id'])->get();
                        if (count($stock) > 0) {
                            StockHistory::create([
                                'stock_id' => $stock[0]->id,
                                'purchase_id' => $item->id,
                                'roll_quantity' => $article['roll_quantity'],
                                'prev_stock' => $stock[0]->stock,
                                'current_stock' => $stock[0]->stock + $article['quantity'],
                                'user_id' => $request->user()->id
                            ]);
                            $stock[0]->update([
                                'stock' => $stock[0]->stock + $article['quantity']
                            ]);
                        }
                    }
                }
            }
            $item->total = $item->articles->sum('total');
            $item->balance = $item->total;
            $item->save();
        }

        $payments = $request->payments;
        if(count($payments) > 0) {
            $item->payments()->createMany($payments);
            $item->balance = $item->total;
            foreach ($payments as $key => $payment) {
                if($item->balance <= 0) {
                    $item->balance = 0;
                    break;
                };
                $item->balance = $item->currency == 1 ? $item->balance-$payment['amount_mxn']:$item->balance-$payment['amount_usd'];
            }
            $item->save();
        }
        
        if($item->balance == $item->total || ($item->balance < $item->total && $item->balance > 0)){
            $item->status = 1;
        }else if($item->balance == 0){
            $item->status = 2;
        }
        $item->save();

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Purchase Created!' : 'Error Creating Purchase'
        ]);
    }

    public function show(Purchase $purchase)
    {
        return response()->json(Purchase::with([
            'office','supplier','user','articles.product','payments'
        ])->find($purchase->id),200);         
    }

    public function update(Request $request, Purchase $purchase)
    {
        $status = $purchase->update(
            $request->only(['office_id','supplier_id','currency'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Purchase Updated!' : 'Error Updating Purchase'
        ]);
    }

    public function destroy(Purchase $purchase)
    {
        $status = $purchase->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Purchase Deleted!' : 'Error Deleting Purchase'
        ]);
    }
}
