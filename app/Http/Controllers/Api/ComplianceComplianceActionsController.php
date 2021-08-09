<?php

namespace App\Http\Controllers\Api;

use App\Models\Compliance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplianceActionResource;
use App\Http\Resources\ComplianceActionCollection;

class ComplianceComplianceActionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compliance $compliance
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Compliance $compliance)
    {
        $this->authorize('view', $compliance);

        $search = $request->get('search', '');

        $complianceActions = $compliance
            ->complianceActions()
            ->search($search)
            ->latest()
            ->paginate();

        return new ComplianceActionCollection($complianceActions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compliance $compliance
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Compliance $compliance)
    {
        $this->authorize('create', ComplianceAction::class);

        $validated = $request->validate([
            'action_taken' => ['required', 'max:255', 'string'],
            'commander_comment' => ['required', 'max:255', 'string'],
            'percentage' => ['required', 'numeric'],
            'updated_date' => ['required', 'date'],
        ]);

        $complianceAction = $compliance
            ->complianceActions()
            ->create($validated);

        return new ComplianceActionResource($complianceAction);
    }
}
