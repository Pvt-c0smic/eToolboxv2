<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ComplianceAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplianceActionResource;
use App\Http\Resources\ComplianceActionCollection;
use App\Http\Requests\ComplianceActionStoreRequest;
use App\Http\Requests\ComplianceActionUpdateRequest;

class ComplianceActionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ComplianceAction::class);

        $search = $request->get('search', '');

        $complianceActions = ComplianceAction::search($search)
            ->latest()
            ->paginate();

        return new ComplianceActionCollection($complianceActions);
    }

    /**
     * @param \App\Http\Requests\ComplianceActionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplianceActionStoreRequest $request)
    {
        $this->authorize('create', ComplianceAction::class);

        $validated = $request->validated();

        $complianceAction = ComplianceAction::create($validated);

        return new ComplianceActionResource($complianceAction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ComplianceAction $complianceAction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ComplianceAction $complianceAction)
    {
        $this->authorize('view', $complianceAction);

        return new ComplianceActionResource($complianceAction);
    }

    /**
     * @param \App\Http\Requests\ComplianceActionUpdateRequest $request
     * @param \App\Models\ComplianceAction $complianceAction
     * @return \Illuminate\Http\Response
     */
    public function update(
        ComplianceActionUpdateRequest $request,
        ComplianceAction $complianceAction
    ) {
        $this->authorize('update', $complianceAction);

        $validated = $request->validated();

        $complianceAction->update($validated);

        return new ComplianceActionResource($complianceAction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ComplianceAction $complianceAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        ComplianceAction $complianceAction
    ) {
        $this->authorize('delete', $complianceAction);

        $complianceAction->delete();

        return response()->noContent();
    }
}
