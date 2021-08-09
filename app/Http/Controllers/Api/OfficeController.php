<?php

namespace App\Http\Controllers\Api;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfficeResource;
use App\Http\Resources\OfficeCollection;
use App\Http\Requests\OfficeStoreRequest;
use App\Http\Requests\OfficeUpdateRequest;

class OfficeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Office::class);

        $search = $request->get('search', '');

        $offices = Office::search($search)
            ->latest()
            ->paginate();

        return new OfficeCollection($offices);
    }

    /**
     * @param \App\Http\Requests\OfficeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeStoreRequest $request)
    {
        $this->authorize('create', Office::class);

        $validated = $request->validated();

        $office = Office::create($validated);

        return new OfficeResource($office);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Office $office)
    {
        $this->authorize('view', $office);

        return new OfficeResource($office);
    }

    /**
     * @param \App\Http\Requests\OfficeUpdateRequest $request
     * @param \App\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeUpdateRequest $request, Office $office)
    {
        $this->authorize('update', $office);

        $validated = $request->validated();

        $office->update($validated);

        return new OfficeResource($office);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Office $office)
    {
        $this->authorize('delete', $office);

        $office->delete();

        return response()->noContent();
    }
}
