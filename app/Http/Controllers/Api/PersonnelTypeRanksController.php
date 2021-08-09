<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PersonnelType;
use App\Http\Resources\RankResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\RankCollection;

class PersonnelTypeRanksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonnelType $personnelType
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PersonnelType $personnelType)
    {
        $this->authorize('view', $personnelType);

        $search = $request->get('search', '');

        $ranks = $personnelType
            ->ranks()
            ->search($search)
            ->latest()
            ->paginate();

        return new RankCollection($ranks);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonnelType $personnelType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PersonnelType $personnelType)
    {
        $this->authorize('create', Rank::class);

        $validated = $request->validate([
            'code' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $rank = $personnelType->ranks()->create($validated);

        return new RankResource($rank);
    }
}
