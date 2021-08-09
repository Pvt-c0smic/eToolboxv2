<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view('app.offices.index', compact('offices', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Office::class);

        return view('app.offices.create');
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

        return redirect()
            ->route('offices.edit', $office)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Office $office)
    {
        $this->authorize('view', $office);

        return view('app.offices.show', compact('office'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Office $office)
    {
        $this->authorize('update', $office);

        return view('app.offices.edit', compact('office'));
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

        return redirect()
            ->route('offices.edit', $office)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('offices.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
