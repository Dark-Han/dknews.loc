<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Category\CreateCategoryRequest;
use App\Http\Requests\V1\Category\DeleteCategoryRequest;
use App\Http\Requests\V1\Category\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Resources\Api\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request, CategoryService $categoryService)
    {
        $category = $categoryService->create($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id, CategoryService $categoryService)
    {
        $categoryService->update($id, $request->validated());
        return new CategoryResource(Category::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteCategoryRequest $request, CategoryService $categoryService)
    {
        $categoryService->delete($id, $request->validated());
        return response()->json();
    }
}
