<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Category\CreateCategoryRequest;
use App\Http\Requests\V1\Category\DeleteCategoryRequest;
use App\Http\Requests\V1\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Api\CategoryService;
use App\Http\Resources\Api\V1\CategoryResource;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api\V1
 */
class CategoryController extends Controller
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return CategoryResource::collection($categories);
    }

    /**
     * @param CreateCategoryRequest $request
     * @param CategoryService $categoryService
     * @return CategoryResource
     */
    public function store(CreateCategoryRequest $request, CategoryService $categoryService)
    {
        $category = $categoryService->create($request->validated());
        return new CategoryResource($category);
    }


    /**
     * @param UpdateCategoryRequest $request
     * @param $id
     * @param CategoryService $categoryService
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request, $id, CategoryService $categoryService)
    {
        $categoryService->update($id, $request->validated());
        return new CategoryResource(Category::find($id));
    }


    /**
     * @param $id
     * @param DeleteCategoryRequest $request
     * @param CategoryService $categoryService
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, DeleteCategoryRequest $request, CategoryService $categoryService)
    {
        $categoryService->delete($id, $request->validated());
        return response()->json();
    }
}
