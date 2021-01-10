<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Media\CreateRequest;
use App\Http\Requests\V1\Media\UpdateRequest;
use App\Http\Resources\Api\V1\MediaResource;
use App\Models\Media;
use App\Services\Api\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    public function index()
    {
        $medias=Media::all();
        return MediaResource::collection($medias);
    }

    public function store(CreateRequest $request,MediaService $mediaService)
    {
        $media=$mediaService->create($request->validated());
        return new MediaResource($media);
    }

    public function update(UpdateRequest $request, $id,MediaService $mediaService)
    {
        $media=$mediaService->update($id,$request->validated());
        return new MediaResource($media);
    }

    public function destroy($id,MediaService $mediaService)
    {
        $mediaService->delete($id);
        return response()->json([]);
    }
}
