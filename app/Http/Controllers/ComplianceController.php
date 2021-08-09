<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Status;
use App\Models\Compliance;
use Illuminate\Http\Request;
use App\Http\Requests\ComplianceStoreRequest;
use App\Http\Requests\ComplianceUpdateRequest;

class ComplianceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Compliance::class);

        $search = $request->get('search', '');

        $compliances = Compliance::search($search)
            ->latest()
            ->paginate(5);

        return view('app.compliances.index', compact('compliances', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Compliance::class);

        $offices = Office::pluck('code', 'id');
        $statuses = Status::pluck('name', 'id');

        return view('app.compliances.create', compact('offices', 'statuses'));
    }

    /**
     * @param \App\Http\Requests\ComplianceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplianceStoreRequest $request)
    {
        $this->authorize('create', Compliance::class);

        $validated = $request->validated();

        $compliance = Compliance::create($validated);

        return redirect()
            ->route('compliances.edit', $compliance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compliance $compliance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Compliance $compliance)
    {
        $this->authorize('view', $compliance);

        return view('app.compliances.show', compact('compliance'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compliance $compliance
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Compliance $compliance)
    {
        $this->authorize('update', $compliance);

        $offices = Office::pluck('code', 'id');
        $statuses = Status::pluck('name', 'id');

        return view(
            'app.compliances.edit',
            compact('compliance', 'offices', 'statuses')
        );
    }

    /**
     * @param \App\Http\Requests\ComplianceUpdateRequest $request
     * @param \App\Models\Compliance $compliance
     * @return \Illuminate\Http\Response
     */
    public function update(
        ComplianceUpdateRequest $request,
        Compliance $compliance
    ) {
        $this->authorize('update', $compliance);

        $validated = $request->validated();

        $compliance->update($validated);

        return redirect()
            ->route('compliances.edit', $compliance)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compliance $compliance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Compliance $compliance)
    {
        $this->authorize('delete', $compliance);

        $compliance->delete();

        return redirect()
            ->route('compliances.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
