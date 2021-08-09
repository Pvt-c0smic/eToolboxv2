<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PersonnelType;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelTypeResource;
use App\Http\Resources\PersonnelTypeCollection;
use App\Http\Requests\PersonnelTypeStoreRequest;
use App\Http\Requests\PersonnelTypeUpdateRequest;

class PersonnelTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', PersonnelType::class);

        $search = $request->get('search', '');

        $personnelTypes = PersonnelType::search($search)
            ->latest()
            ->paginate();

        return new PersonnelTypeCollection($personnelTypes);
    }

    /**
     * @param \App\Http\Requests\PersonnelTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonnelTypeStoreRequest $request)
    {
        $this->authorize('create', PersonnelType::class);

        $validated = $request->validated();

        $personnelType = PersonnelType::create($validated);

        return new PersonnelTypeResource($personnelType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonnelType $personnelType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PersonnelType $personnelType)
    {
        $this->authorize('view', $personnelType);

        return new PersonnelTypeResource($personnelType);
    }

    /**
     * @param \App\Http\Requests\PersonnelTypeUpdateRequest $request
     * @param \App\Models\PersonnelType $personnelType
     * @return \Illuminate\Http\Response
     */
    public function update(
        PersonnelTypeUpdateRequest $request,
        PersonnelType $personnelType
    ) {
        $this->authorize('update', $personnelType);

        $validated = $request->validated();

        $personnelType->update($validated);

        return new PersonnelTypeResource($personnelType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonnelType $personnelType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PersonnelType $personnelType)
    {
        $this->authorize('delete', $personnelType);

        $personnelType->delete();

        return response()->noContent();
    }
}
