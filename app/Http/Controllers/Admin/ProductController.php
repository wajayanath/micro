<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\ProductResource;
use App\Product;
use function env;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{
    public function index()
    {
        Gate::authorize('view','products');

        $products = Product::paginate();

        return ProductResource::collection($products);
    }

    public function show($id)
    {
        Gate::authorize('view','products');

        return new ProductResource(Product::find($id));
    }

    public function store(ProductCreateRequest $request)
    {
         Gate::authorize('edit','products');

         $product = Product::create($request->only('title', 'description', 'image', 'price'));

         return response($product, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('edit','products');

        $product = Product::find($id);

        $product->update($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Gate::authorize('edit','products');

        Product::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
