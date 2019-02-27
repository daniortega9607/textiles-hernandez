<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::select('products.*')->with(['fabric','color','design','stock']);
        if (isset($request->search)) {
            $query->join('fabrics','fabrics.id','=','products.fabric_id');
            $query->leftJoin('colors','colors.id','=','products.color_id');
            $query->leftJoin('designs','designs.id','=','products.design_id');
            $query->where('products.sku','like','%'.$request->search.'%')
            ->orWhere('fabrics.name','like','%'.$request->search.'%')
            ->orWhere('colors.name','like','%'.$request->search.'%')
            ->orWhere('designs.name','like','%'.$request->search.'%');
        }
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
            return response()->json($query->paginate($paginate),200);
        }
        return response()->json($query->get(),200);
    }

    public function store(Request $request)
    {
        $item = Product::create($request->only([
            'sku','fabric_id','design_id','color_id'
        ]));

        return response()->json([
            'status' => (bool) $item,
            'data'   => $item,
            'message' => $item ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    public function show(Product $product)
    {
        return response()->json(Product::with(['fabric','design','color','stock'])->find($product->id),200);         
    }

    public function update(Request $request, Product $product)
    {
        $status = $product->update(
            $request->only(['sku','fabric_id','design_id','color_id'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy(Product $product)
    {
        $status = $product->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
