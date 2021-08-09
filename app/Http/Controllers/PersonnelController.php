<?php

namespace App\Http\Controllers;

use App\Models\Bos;
use App\Models\Rank;
use App\Models\Office;
use App\Models\Personnel;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view(
            'app.all_personnel.index',
            compact('allPersonnel', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Personnel::class);

        $ranks = Rank::pluck('code', 'id');
        $allBos = Bos::pluck('code', 'id');
        $offices = Office::pluck('code', 'id');

        return view(
            'app.all_personnel.create',
            compact('ranks', 'allBos', 'offices')
        );
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

        return redirect()
            ->route('all-personnel.edit', $personnel)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Personnel $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Personnel $personnel)
    {
        $this->authorize('view', $personnel);

        return view('app.all_personnel.show', compact('personnel'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Personnel $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Personnel $personnel)
    {
        $this->authorize('update', $personnel);

        $ranks = Rank::pluck('code', 'id');
        $allBos = Bos::pluck('code', 'id');
        $offices = Office::pluck('code', 'id');

        return view(
            'app.all_personnel.edit',
            compact('personnel', 'ranks', 'allBos', 'offices')
        );
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

        return redirect()
            ->route('all-personnel.edit', $personnel)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-personnel.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
