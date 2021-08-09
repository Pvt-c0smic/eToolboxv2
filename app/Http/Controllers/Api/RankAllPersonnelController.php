<?php

namespace App\Http\Controllers\Api;

use App\Models\Rank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use App\Http\Resources\PersonnelCollection;

class RankAllPersonnelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Rank $rank)
    {
        $this->authorize('view', $rank);

        $search = $request->get('search', '');

        $allPersonnel = $rank
            ->allPersonnel()
            ->search($search)
            ->latest()
            ->paginate();

        return new PersonnelCollection($allPersonnel);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rank $rank
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Rank $rank)
    {
        $this->authorize('create', Personnel::class);

        $validated = $request->validate([
            'last_name' => ['required', 'max:255', 'string'],
            'first_name' => ['required', 'max:255', 'string'],
            'middle_name' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'phone_number' => ['nullable', 'max:255', 'string'],
            'afpsn' => ['nullable', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'bos_id' => ['required', 'exists:rf_bos,id'],
            'office_id' => ['required', 'exists:rf_offices,id'],
            'designation' => ['required', 'max:255', 'string'],
        ]);

        $personnel = $rank->allPersonnel()->create($validated);

        return new PersonnelResource($personnel);
    }
}
