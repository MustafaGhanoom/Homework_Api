<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

use App\Http\Resources\ProductResource;

use App\Models\Product;
use App\Traits\ResponseTrait;

class ProductController extends Controller
{
    use ResponseTrait;

    /**
     * Retrieve all products.
     */
    public function index()
    {
        $allProducts = Product::all();



        return ProductResource::collection($allProducts);



    }

    /**
     * Store a newly created product.
     */

    public function store(ProductRequest $request)
    {
                $newProduct = Product::create($request->validated());


        if ($request->has('tags_id'))
            {


            $newProduct->tags()->attach($request->tags_id);
             }




        return $this->successResponse("Product created successfully", 201);
    }

    /**
     * Show a specific product.
     */
    public function show(string $id)
    {

         $product = Product::find($id);

        if (!$product)
        {

            return $this->errorResponse("Product not found", 404);

        }


        return $this->dataResponse('product', new ProductResource($product), "Product found", 200);
    }

    /**
     * Update a specific product.
     */
    public function update(ProductRequest $request, $id)
    {

        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse("Product not found", 404);
        }

        $product->update($request->validated());

        if ($request->has('tags_id'))
        {


            $product->tags()->sync($request->tags_id);
        }

        return $this->successResponse("Product updated successfully", 200);
    }

    /**
     * Delete a specific product.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product)
            {
            return $this->errorResponse("Product not found", 404);
        }

        $product->tags()->detach();

        $product->delete();

        return $this->successResponse("Product deleted successfully", 200);
    }


}
