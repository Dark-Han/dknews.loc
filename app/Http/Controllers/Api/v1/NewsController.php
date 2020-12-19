<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\News\CreateRequest;
use App\Http\Requests\V1\News\DeleteUploadedImagesRequest;
use App\Http\Requests\V1\News\ImageUploadRequest;
use App\Http\Requests\V1\News\UpdateRequest;
use App\Http\Resources\Api\V1\NewsResource;
use App\Models\News;
use App\Services\Api\NewsService;
use Illuminate\Http\Request;


/**
 * Class NewsController
 * @package App\Http\Controllers\Api\V1
 */
class NewsController extends Controller
{

    /**
     * @param NewsService $newsService
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(NewsService $newsService)
    {
        $news=$newsService->all();
        return NewsResource::collection($news);
    }

    /**
     * @param CreateRequest $request
     * @param NewsService $newsService
     * @return NewsResource
     */
    public function store(CreateRequest $request, NewsService $newsService)
    {
        $news=$newsService->create($request->validated());
        return new NewsResource($news);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @param NewsService $newsService
     * @return NewsResource
     */
    public function update(UpdateRequest $request, $id, NewsService $newsService)
    {
        $news=$newsService->update($request->validated(),$id);
        return new NewsResource($news);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        News::destroy($id);
        return response()->json([]);
    }

    /**
     * @param ImageUploadRequest $request
     * @param NewsService $newsService
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(ImageUploadRequest $request, NewsService $newsService)
    {
        $path=$newsService->uploadImage($request->file);
        return response()->json(['path'=>$path]);
    }

    /**
     * @param DeleteUploadedImagesRequest $request
     * @param NewsService $newsService
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage(DeleteUploadedImagesRequest $request, NewsService $newsService){
        $newsService->deleteUploadedImagesOfNotCreatedNews($request->validated());
        return response()->json([]);
    }
}
