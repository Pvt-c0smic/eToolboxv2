<?php

namespace App\Http\Controllers\Api;

use App\Models\Personnel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use App\Http\Resources\PersonnelCollection;
use App\Http\Requests\PersonnelStoreRequest;
use App\Http\Requests\PersonnelUpdateRequest;

class PersonnelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Personnel::class);

        $search = $request->get('search', '');

        $allPersonnel = Personnel::search($search)
            ->latest()
            ->paginate();

        return new PersonnelCollection($allPersonnel);
    }

    /**
     * @param \App\Http\Requests\PersonnelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonnelStoreRequest $request)
    {
        $this->authorize('create', Personnel::class);

        $validated = $request->validated();

        $personnel = Personnel::create($validated);

        return new PersonnelResource($personnel);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Personnel $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Personnel $personnel)
    {
        $this->authorize('view', $personnel);

        return new PersonnelResource($personnel);
    }

    /**
     * @param \App\Http\Requests\PersonnelUpdateRequest $request
     * @param \App\Models\Personnel $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(
        PersonnelUpdateRequest $request,
        Personnel $personnel
    ) {
        $this->authorize('update', $personnel);

        $validated = $request->validated();

        $personnel->update($validated);

        return new PersonnelResource($personnel);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Personnel $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Personnel $personnel)
    {
        $this->authorize('delete', $personnel);

        $personnel->delete();

        return response()->noContent();
    }
}
