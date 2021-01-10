<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BannerWeb\CreateRequest;
use App\Http\Requests\V1\BannerWeb\UpdateRequest;
use App\Models\BannerWeb;
use App\Services\Api\BannerWebService;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\BannerWebResource;


class BannerWebController extends Controller
{

    public function index()
    {
        $bannerWeb=BannerWeb::with('limit','disposition','serial_number','category')->get();
        return BannerWebResource::collection($bannerWeb);
    }

    public function store(CreateRequest $request, BannerWebService $bannerWebService)
    {
        $banner=$bannerWebService->create($request->validated());
        $banner=new BannerWebResource($banner);
        return response()->json($banner);
    }


    public function update(UpdateRequest $request, $id,BannerWebService $bannerWebService)
    {
        $banner=$bannerWebService->update($id,$request->validated());
        return new BannerWebResource($banner);
    }

    public function destroy($id,BannerWebService $bannerWebService)
    {
        $bannerWebService->delete($id);
        return response()->json();
    }
}
