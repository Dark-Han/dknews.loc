<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Journal\CreateRequest;
use App\Http\Requests\V1\Journal\UpdateRequest;
use App\Http\Resources\Api\V1\JournalResource;
use App\Models\Journal;
use App\Services\Api\JournalService;

/**
 * Class JournalController
 * @package App\Http\Controllers\Api\V1
 */
class JournalController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $journals=Journal::with('journalTypes')->get();
        return JournalResource::collection($journals);
    }

    /**
     * @param CreateRequest $request
     * @param JournalService $journalService
     * @return JournalResource
     */
    public function store(CreateRequest $request, JournalService $journalService){
        $journal=$journalService->create($request->validated());
        return new JournalResource($journal);
    }

    /**
     * @param UpdateRequest $request
     * @param JournalService $journalService
     * @return JournalResource
     */
    public function update(UpdateRequest $request,$id,JournalService $journalService){
        $journal=$journalService->update($request->validated(),$id);
        return new JournalResource($journal);
    }

    /**
     * @param $id
     * @param JournalService $journalService
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, JournalService $journalService){
        $journalService->delete($id);
        return response()->json([]);
    }
}
