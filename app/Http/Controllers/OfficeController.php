<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        return response()->json(Office::all(),200);
    }

    public function store(Request $request)
    {
        $item = Office::create($request->only([
            'name','address','phone'
        ]));

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Office Created!' : 'Error Creating Office'
        ]);
    }

    public function show(Office $office)
    {
        return response()->json($office,200);         
    }

    public function update(Request $request, Office $office)
    {
        $status = $office->update(
            $request->only(['name','address','phone'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Office Updated!' : 'Error Updating Office'
        ]);
    }

    public function destroy(Office $office)
    {
        $status = $office->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Office Deleted!' : 'Error Deleting Office'
        ]);
    }
}
