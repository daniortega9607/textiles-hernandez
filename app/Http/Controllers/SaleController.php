<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Customer;
use App\Sale;
use App\StockHistory;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::selectRaw('sales.*, IF(currency=1,"MXN","USD") as currency')->with(['office','customer','user']);
        $ids = Sale::select('sales.id');
        $query->leftJoin('customers','customers.id','=','sales.customer_id');
        $ids->leftJoin('customers','customers.id','=','sales.customer_id');
        $query->leftJoin('users','users.id','=','sales.user_id');
        $ids->leftJoin('users','users.id','=','sales.user_id');
        if (isset($request->search)) {
            $query->where('customers.name','like','%'.$request->search.'%')
            ->orWhere('users.name','like','%'.$request->search.'%');
            $ids->where('customers.name','like','%'.$request->search.'%')
            ->orWhere('users.name','like','%'.$request->search.'%');
        }
        if($request->user()->user_type == 3 && !is_null($request->user()->customer_id)){
            $query->where('customer_id',$request->user()->customer_id);
            $ids->where('customer_id',$request->user()->customer_id);
        }
        else if($request->user()->user_type == 3 && is_null($request->user()->customer_id)){
            return response()->json(null,403);
        }
        if($request->user()->user_type == 2){
            $query->where('user_id',$request->user()->id);
            $ids->where('user_id',$request->user()->id);
        }
        $query->orderBy('created_at','desc');
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
            $totals = collect([
                'totals' => Sale::selectRaw('
                    SUM(revenue) as revenue, SUM(commission) as commission, SUM(balance) as balance, SUM(total) as total, IF(currency=1,"MXN","USD") as currency
                ')->whereIn('id',$ids->get())->groupBy('currency')->get()
            ]);
            $data = $totals->merge($query->paginate($paginate));
            return response()->json($data,200);
        }
        return response()->json($query->get(),200);
    }

    public function store(Request $request)
    {
        $sale = $request->only([
            'office_id','customer_id','currency','balance','total','status'
        ]);
        $sale['user_id'] = $request->user()->id;
        $item = Sale::create($sale);

        if(isset($request->customer) && is_null($request->customer_id) 
            && !is_null($request->customer['name'])){
            $customer = Customer::create(['name' => $request->customer['name']]);
            $item->customer_id = $customer->id;   
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
                                'sale_id' => $item->id,
                                'prev_stock' => $stock[0]->stock,
                                'current_stock' => $stock[0]->stock - $article['quantity'],
                                'user_id' => $request->user()->id
                            ]);
                            $stock[0]->update([
                                'stock' => $stock[0]->stock - $article['quantity']
                            ]);
                        }
                    }
                }
            }
            $item->total = $item->articles->sum('total');
            $item->balance = $item->total;
            $item->revenue = $item->articles->sum('revenue');
            $item->commission = $item->articles->sum('commission');
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
            'message' => $item ? 'Sale Created!' : 'Error Creating Sale'
        ]);
    }

    public function show(Sale $sale)
    {
        return response()->json(Sale::with([
            'office','customer','user','articles.product','payments'
        ])->find($sale->id),200);         
    }

    public function update(Request $request, Sale $sale)
    {
        $status = $sale->update(
            $request->only(['office_id','customer_id','currency'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Sale Updated!' : 'Error Updating Sale'
        ]);
    }

    public function destroy(Sale $sale)
    {
        $status = $sale->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Sale Deleted!' : 'Error Deleting Sale'
        ]);
    }
}
