<?php

namespace App\Http\Controllers\Api;

use App\Models\Compliance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplianceResource;
use App\Http\Resources\ComplianceCollection;
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
            ->paginate();

        return new ComplianceCollection($compliances);
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

        return new ComplianceResource($compliance);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Compliance $compliance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Compliance $compliance)
    {
        $this->authorize('view', $compliance);

        return new ComplianceResource($compliance);
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

        return new ComplianceResource($compliance);
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

        return response()->noContent();
    }
}
