<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return response(Product::orderBy('id', 'desc')->get()->toArray());
    }

    public function store(ProductStoreRequest $request)
    {        
        foreach ($request->validated()['products'] as $product) {
            if (!empty($product)) {
                Product::create($product);                            
            }
        }

        return response('Product(s) created successfuly');
    }

    public function show(Request $request, Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Request $request, Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('product.index');
    }


    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }
}
