<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Newspaper\StoreRequest;
use App\Http\Requests\V1\Newspaper\UpdateRequest;
use App\Services\Api\NewspaperService;
use App\Models\Newspaper;
use App\Http\Resources\Api\V1\NewspaperResource;

/**
 * Class NewspaperController
 * @package App\Http\Controllers\Api\V1
 */
class NewspaperController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $newspapers=Newspaper::all();
        return NewspaperResource::collection($newspapers);
    }

    /**
     * @param StoreRequest $request
     * @param NewspaperService $newspaperService
     * @return NewspaperResource
     */
    public function store(StoreRequest $request, NewspaperService $newspaperService)
    {
        $newspaper=$newspaperService->create($request->validated());
        return new NewspaperResource($newspaper);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @param NewspaperService $newspaperService
     * @return NewspaperResource
     */
    public function update(UpdateRequest $request, $id, NewspaperService $newspaperService)
    {
        $newspaperService->update($id,$request->validated());
        $newspaper=Newspaper::find($id);
        return new NewspaperResource($newspaper);
    }

    /**
     * @param $id
     * @param NewspaperService $newspaperService
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, NewspaperService $newspaperService)
    {
            $newspaperService->delete($id);
            return response()->json();
    }
}
