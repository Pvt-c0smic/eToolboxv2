<?php

namespace App\Http\Controllers\Api;

use App\Models\Bos;
use Illuminate\Http\Request;
use App\Http\Resources\BosResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BosCollection;
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
            ->paginate();

        return new BosCollection($allBos);
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

        return new BosResource($bos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bos $bos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bos $bos)
    {
        $this->authorize('view', $bos);

        return new BosResource($bos);
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

        return new BosResource($bos);
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

        return response()->noContent();
    }
}
