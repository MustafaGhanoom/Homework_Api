<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

use App\Models\Category;


use App\Traits\ResponseMessage;

class CategoryController extends Controller
{
    use ResponseMessage;

    /**
     * Display a list of categories.
     */
    public function index()
    {


        $categories = Category::all();

        return CategoryResource::collection($categories);


    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return $this->successMessage($category,201);
    }

    /**
     * Display the specified category.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category)

        {

                 return $this->errorMessage(404);
        }

        return $this->dataResponse('category', 200);
    }

    /**
     * Update the specified category.
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if (!$category)
         {
                  return $this->errorMessage( $category,404);
        }

           $category->update($request->validated());

        return $this->successMessage($category, 200);
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category)
           {
            return $this->errorMessage(404);
        }

        $category->delete();


        return $this->successMessage(204);
    }
}
