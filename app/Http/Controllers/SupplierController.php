<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::select('suppliers.*');
        if (isset($request->search)) {
            $query->where('name','like','%'.$request->search.'%')
            ->orWhere('address','like','%'.$request->search.'%')
            ->orWhere('telephone','like','%'.$request->search.'%')
            ->orWhere('mobilephone','like','%'.$request->search.'%')
            ->orWhere('email','like','%'.$request->search.'%')
            ->orWhere('comments','like','%'.$request->search.'%');
        }
        if(isset($request->balance) && $request->balance){
            $query->with(['purchases','balance']);
            $query->join('purchases','purchases.supplier_id','=','suppliers.id');
            $query->where('purchases.deleted_at',NULL);
            $query->where('purchases.balance','>',0);
            $query->groupBy('suppliers.id');
        }
        $query->orderBy('name');
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
            if(isset($request->balance) && $request->balance) {
                $totals = collect([
                    'totals' => ['balance'=>Purchase::sum('balance')]
                ]);
                $data = $totals->merge($query->paginate($paginate));
                return response()->json($data, 200);
            }
            return response()->json($query->paginate($paginate),200);
        }
        return response()->json($query->get(),200);
    }

    public function store(Request $request)
    {
        $item = Supplier::create($request->only([
            'name','address','phone','mobilephone','email','comments'
        ]));

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Supplier Created!' : 'Error Creating Supplier'
        ]);
    }

    public function show(Supplier $supplier)
    {
        return response()->json($supplier,200);         
    }

    public function update(Request $request, Supplier $supplier)
    {
        $status = $supplier->update(
            $request->only(['name','address','phone','mobilephone','email','comments'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Supplier Updated!' : 'Error Updating Supplier'
        ]);
    }

    public function destroy(Supplier $supplier)
    {
        $status = $supplier->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Supplier Deleted!' : 'Error Deleting Supplier'
        ]);
    }
}
