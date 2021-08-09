<?php

namespace App\Http\Controllers;

use App\Models\Compliance;
use Illuminate\Http\Request;
use App\Models\ComplianceAction;
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
            ->paginate(5);

        return view(
            'app.compliance_actions.index',
            compact('complianceActions', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', ComplianceAction::class);

        $compliances = Compliance::pluck('start_date', 'id');

        return view('app.compliance_actions.create', compact('compliances'));
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

        return redirect()
            ->route('compliance-actions.edit', $complianceAction)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ComplianceAction $complianceAction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ComplianceAction $complianceAction)
    {
        $this->authorize('view', $complianceAction);

        return view('app.compliance_actions.show', compact('complianceAction'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ComplianceAction $complianceAction
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ComplianceAction $complianceAction)
    {
        $this->authorize('update', $complianceAction);

        $compliances = Compliance::pluck('start_date', 'id');

        return view(
            'app.compliance_actions.edit',
            compact('complianceAction', 'compliances')
        );
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

        return redirect()
            ->route('compliance-actions.edit', $complianceAction)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('compliance-actions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
