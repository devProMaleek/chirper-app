<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Http\Requests\StoreChirpRequest;
use App\Http\Requests\UpdateChirpRequest;
use Inertia\Inertia;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $chirps = Chirp::with('user:id,name')->latest()->get();
        return Inertia::render('Chirps/Index', [
            'chirps' => $chirps,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChirpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChirpRequest $request)
    {
        //
        $this->authorize('create', Chirp::class);

        $chirp = $request->user()->chirps()->create($request->validated());

        if ($chirp) {
            return redirect()->route('chirps.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChirpRequest  $request
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChirpRequest $request, Chirp $chirp)
    {
        //
        $this->authorize('update', $chirp);
        $validated = $request->validated();
        $updated = $chirp->update($validated);

        if ($updated) {
            return redirect()->route('chirps.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
