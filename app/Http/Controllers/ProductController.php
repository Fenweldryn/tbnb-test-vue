<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductBulkUpdateRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return response(Product::select('id','name','slug','price','quantity')->orderBy('id', 'desc')->get()->toArray());
    }

    public function store(ProductStoreRequest $request)
    {        
        foreach ($request->validated()['products'] as $product) {
            if (!empty($product)) {
                Product::create($product);                            
            }
        }

        return response('Product(s) created successfuly', 201);
    }

    public function show(Request $request, Product $product)
    {
        $logs = Activity::where('subject_id', $product->id)
            ->where('subject_type', 'App\Models\Product')
            ->orderBy('created_at', 'asc')
            ->get();   

        return response([
            "product" => $product->toArray(),
            "logs" => $logs
        ]);
    }

    public function edit(Request $request, Product $product)
    {
        return response($product->toArray());
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {        
        $validated = $request->validated();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->quantity = $validated['quantity'];
        $product->update();

        return response('Product updated successfuly');
    }

    public function bulkUpdate(ProductBulkUpdateRequest $request)
    {
        foreach ($request->validated()['products'] as $changedProduct) {            
            if (!empty($changedProduct)) {
                $product = Product::find($changedProduct['id']);
                $product->name = $changedProduct['name'];
                $product->price = $changedProduct['price'];
                $product->quantity = $changedProduct['quantity'];
                $product->update();            
            }
        }

        return response('Product(s) updated successfuly');
    }


    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return response('Product deleted successfuly');
    }
}
