<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;
use App\Models\PersonnelType;
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
            ->paginate(5);

        return view('app.ranks.index', compact('ranks', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Rank::class);

        $personnelTypes = PersonnelType::pluck('name', 'id');

        return view('app.ranks.create', compact('personnelTypes'));
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

        return redirect()
            ->route('ranks.edit', $rank)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Rank $rank)
    {
        $this->authorize('view', $rank);

        return view('app.ranks.show', compact('rank'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Rank $rank)
    {
        $this->authorize('update', $rank);

        $personnelTypes = PersonnelType::pluck('name', 'id');

        return view('app.ranks.edit', compact('rank', 'personnelTypes'));
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

        return redirect()
            ->route('ranks.edit', $rank)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('ranks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
