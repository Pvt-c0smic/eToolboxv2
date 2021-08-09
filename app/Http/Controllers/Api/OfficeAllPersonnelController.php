<?php

namespace App\Http\Controllers\Api;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use App\Http\Resources\PersonnelCollection;

class OfficeAllPersonnelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Office $office)
    {
        $this->authorize('view', $office);

        $search = $request->get('search', '');

        $allPersonnel = $office
            ->allPersonnel()
            ->search($search)
            ->latest()
            ->paginate();

        return new PersonnelCollection($allPersonnel);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Office $office)
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
            'rank_id' => ['required', 'exists:rf_ranks,id'],
            'bos_id' => ['required', 'exists:rf_bos,id'],
            'designation' => ['required', 'max:255', 'string'],
        ]);

        $personnel = $office->allPersonnel()->create($validated);

        return new PersonnelResource($personnel);
    }
}
