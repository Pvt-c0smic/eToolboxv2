<?php

namespace App\Http\Controllers;

use App\Models\Bos;
use Illuminate\Http\Request;
use App\Http\Requests\BosStoreRequest;
use App\Http\Requests\BosUpdateRequest;

class BosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Bos::class);

        $search = $request->get('search', '');

        $allBos = Bos::search($search)
            ->latest()
            ->paginate(5);

        return view('app.all_bos.index', compact('allBos', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Bos::class);

        return view('app.all_bos.create');
    }

    /**
     * @param \App\Http\Requests\BosStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BosStoreRequest $request)
    {
        $this->authorize('create', Bos::class);

        $validated = $request->validated();

        $bos = Bos::create($validated);

        return redirect()
            ->route('all-bos.edit', $bos)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bos $bos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bos $bos)
    {
        $this->authorize('view', $bos);

        return view('app.all_bos.show', compact('bos'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bos $bos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bos $bos)
    {
        $this->authorize('update', $bos);

        return view('app.all_bos.edit', compact('bos'));
    }

    /**
     * @param \App\Http\Requests\BosUpdateRequest $request
     * @param \App\Models\Bos $bos
     * @return \Illuminate\Http\Response
     */
    public function update(BosUpdateRequest $request, Bos $bos)
    {
        $this->authorize('update', $bos);

        $validated = $request->validated();

        $bos->update($validated);

        return redirect()
            ->route('all-bos.edit', $bos)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bos $bos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bos $bos)
    {
        $this->authorize('delete', $bos);

        $bos->delete();

        return redirect()
            ->route('all-bos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
