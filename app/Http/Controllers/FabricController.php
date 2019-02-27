<?php

namespace App\Http\Controllers;

use App\Fabric;
use Illuminate\Http\Request;

class FabricController extends Controller
{
    public function index(Request $request)
    {
        $query = Fabric::select('*');
        if (isset($request->search)) {
            $query->where('name','like','%'.$request->search.'%')
            ->orWhere('buy_price','like','%'.$request->search.'%')
            ->orWhere('sell_price','like','%'.$request->search.'%');
        }
        $query->orderBy('name');
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
            return response()->json($query->paginate($paginate),200);
        }
        return response()->json($query->get(),200);
    }

    public function store(Request $request)
    {
        $item = Fabric::create($request->only([
            'name','buy_price','sell_price'
        ]));

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Fabric Created!' : 'Error Creating Fabric'
        ]);
    }

    public function show(Fabric $fabric)
    {
        return response()->json($fabric,200);         
    }

    public function update(Request $request, Fabric $fabric)
    {
        $status = $fabric->update(
            $request->only(['name','buy_price','sell_price'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Fabric Updated!' : 'Error Updating Fabric'
        ]);
    }

    public function destroy(Fabric $fabric)
    {
        $status = $fabric->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Fabric Deleted!' : 'Error Deleting Fabric'
        ]);
    }
}
