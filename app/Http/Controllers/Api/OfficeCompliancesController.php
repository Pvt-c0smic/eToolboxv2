<?php

namespace App\Http\Controllers\Api;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplianceResource;
use App\Http\Resources\ComplianceCollection;

class OfficeCompliancesController extends Controller
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

        $compliances = $office
            ->compliances()
            ->search($search)
            ->latest()
            ->paginate();

        return new ComplianceCollection($compliances);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Office $office)
    {
        $this->authorize('create', Compliance::class);

        $validated = $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'project_name' => ['required', 'max:255', 'string'],
            'status_id' => ['required', 'exists:rf_statuses,id'],
        ]);

        $compliance = $office->compliances()->create($validated);

        return new ComplianceResource($compliance);
    }
}
