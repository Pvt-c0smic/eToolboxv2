<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplianceResource;
use App\Http\Resources\ComplianceCollection;

class StatusCompliancesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Status $status
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Status $status)
    {
        $this->authorize('view', $status);

        $search = $request->get('search', '');

        $compliances = $status
            ->compliances()
            ->search($search)
            ->latest()
            ->paginate();

        return new ComplianceCollection($compliances);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Status $status
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Status $status)
    {
        $this->authorize('create', Compliance::class);

        $validated = $request->validate([
            'office_id' => ['required', 'exists:rf_offices,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'project_name' => ['required', 'max:255', 'string'],
        ]);

        $compliance = $status->compliances()->create($validated);

        return new ComplianceResource($compliance);
    }
}
