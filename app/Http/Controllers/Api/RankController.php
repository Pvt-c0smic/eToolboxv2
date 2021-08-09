<?php

namespace App\Http\Controllers\Api;

use App\Models\Rank;
use Illuminate\Http\Request;
use App\Http\Resources\RankResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\RankCollection;
use App\Http\Requests\RankStoreRequest;
use App\Http\Requests\RankUpdateRequest;

class RankController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Rank::class);

        $search = $request->get('search', '');

        $ranks = Rank::search($search)
            ->latest()
            ->paginate();

        return new RankCollection($ranks);
    }

    /**
     * @param \App\Http\Requests\RankStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RankStoreRequest $request)
    {
        $this->authorize('create', Rank::class);

        $validated = $request->validated();

        $rank = Rank::create($validated);

        return new RankResource($rank);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Rank $rank)
    {
        $this->authorize('view', $rank);

        return new RankResource($rank);
    }

    /**
     * @param \App\Http\Requests\RankUpdateRequest $request
     * @param \App\Models\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function update(RankUpdateRequest $request, Rank $rank)
    {
        $this->authorize('update', $rank);

        $validated = $request->validated();

        $rank->update($validated);

        return new RankResource($rank);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Rank $rank)
    {
        $this->authorize('delete', $rank);

        $rank->delete();

        return response()->noContent();
    }
}
