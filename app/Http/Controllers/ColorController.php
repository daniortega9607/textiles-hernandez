<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        $query = Color::select('*');
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
        $item = Color::create($request->only([
            'name','value'
        ]));

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Color Created!' : 'Error Creating Color'
        ]);
    }

    public function show(Color $color)
    {
        return response()->json($color,200);         
    }

    public function update(Request $request, Color $color)
    {
        $status = $color->update(
            $request->only(['name','value'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Color Updated!' : 'Error Updating Color'
        ]);
    }

    public function destroy(Color $color)
    {
        $status = $color->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Color Deleted!' : 'Error Deleting Color'
        ]);
    }
}
