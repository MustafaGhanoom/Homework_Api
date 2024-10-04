<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;

use App\Http\Resources\TagResource;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Traits\ResponseTrait;

class TagController extends Controller
{
    use ResponseTrait;

    /**
     * Retrieve a list of all tags.
     */
    public function index()
    {
    $allTags = Tag::all();

            return TagResource::collection($allTags);
    }

    /**
     * Create a new tag.
     */
    public function store(TagRequest $request)
    {
        Tag::create($request->validated());

                return $this->successMessage("Tag created successfully", 201);
            }

    /**
     * Show a specific tag.
     */
    public function show(string $id)
    {
          $tag = Tag::find($id);

        if (!$tag) {


            return $this->errorMessage("Tag not found", 404);

        }

    return $this->dataResponse($tag,"tag", 200);
}

    /**
     * Update a specific tag.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::find($id);

        if (!$tag)
         {


            return $this->errorMessage("Tag not found", 404);

        }

        $tag->update($request->all());

        return $this->dataResponse($tag, "Tag updated successfully", 200);
    }

    /**
     * Delete a specific tag.
     */
    public function destroy(string $id)
    {


        $tag = Tag::find($id);

        if (!$tag)
         {
             return $this->errorMessage("Tag not found", 404);


        }

        $tag->delete();

    return $this->successMessage("Tag deleted successfully", 200);

}

}
