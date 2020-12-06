<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\LinkType;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Http\Requests\V1\Link\StoreRequest;
use App\Http\Requests\V1\Link\UpdateRequest;
use App\Services\LinkService;
/**
 * Class LinkController
 * @package App\Http\Controllers\Api\V1
 */
class LinkController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data['links']=Link::with('linkTypes')->get();
        $data['link_types']=LinkType::all();
        return response()->json($data);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $link=Link::create($request->validated());
        $data['link']=Link::with('linkTypes')->find($link->id);
        return response()->json($data);
    }

    /**
     * @param $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateRequest $request)
    {
        $link=Link::where('id',$id)->update($request->validated());
        $data['link']=Link::with('linkTypes')->find($id);
        return response()->json($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Link::destroy($id);
        return response()->json();
    }
}
