<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::select('customers.*');
        if (isset($request->search)) {
            $query->where('name','like','%'.$request->search.'%')
            ->orWhere('address','like','%'.$request->search.'%')
            ->orWhere('phone','like','%'.$request->search.'%')
            ->orWhere('mobilephone','like','%'.$request->search.'%')
            ->orWhere('email','like','%'.$request->search.'%')
            ->orWhere('comments','like','%'.$request->search.'%');
        }
        if(isset($request->balance) && $request->balance){
            $query->with(['sales','balance']);
            $query->join('sales','sales.customer_id','=','customers.id');
            $query->where('sales.deleted_at',NULL);
            $query->where('sales.balance','>',0);
            $query->groupBy('customers.id');
        }
        $query->orderBy('name');
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
            if(isset($request->balance) && $request->balance) {
                $totals = collect([
                    'totals' => ['balance'=>Sale::sum('balance')]
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
        $item = Customer::create($request->only([
            'name','address','phone','mobilephone','email','credit_days','comments'
        ]));

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Customer Created!' : 'Error Creating Customer'
        ]);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer,200);         
    }

    public function update(Request $request, Customer $customer)
    {
        $status = $customer->update(
            $request->only(['name','address','phone','mobilephone','email','credit_days','comments'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Customer Updated!' : 'Error Updating Customer'
        ]);
    }

    public function destroy(Customer $customer)
    {
        $status = $customer->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Customer Deleted!' : 'Error Deleting Customer'
        ]);
    }
}
