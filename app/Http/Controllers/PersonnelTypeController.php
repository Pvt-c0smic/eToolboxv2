<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonnelType;
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
            ->paginate(5);

        return view(
            'app.personnel_types.index',
            compact('personnelTypes', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', PersonnelType::class);

        return view('app.personnel_types.create');
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

        return redirect()
            ->route('personnel-types.edit', $personnelType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonnelType $personnelType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PersonnelType $personnelType)
    {
        $this->authorize('view', $personnelType);

        return view('app.personnel_types.show', compact('personnelType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PersonnelType $personnelType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PersonnelType $personnelType)
    {
        $this->authorize('update', $personnelType);

        return view('app.personnel_types.edit', compact('personnelType'));
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

        return redirect()
            ->route('personnel-types.edit', $personnelType)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('personnel-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
