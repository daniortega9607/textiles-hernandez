<?php

namespace App\Http\Controllers;

use App\Design;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function index(Request $request)
    {
        $query = Design::select('*');
        if (isset($request->search)) {
            $query->where('name','like','%'.$request->search.'%');
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
        $item = Design::create($request->only([
            'name'
        ]));

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Design Created!' : 'Error Creating Design'
        ]);
    }

    public function show(Design $design)
    {
        return response()->json($design,200);         
    }

    public function update(Request $request, Design $design)
    {
        $status = $design->update(
            $request->only(['name'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Design Updated!' : 'Error Updating Design'
        ]);
    }

    public function destroy(Design $design)
    {
        $status = $design->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Design Deleted!' : 'Error Deleting Design'
        ]);
    }
}
