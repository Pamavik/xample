<?php

namespace App\Http\Controllers;

use App\Models\Xample;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Inertia\Inertia;
use Inertia\Response;

class XampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userID = auth()->user()->id;
        return Inertia::render('Teacher/Xample/Index', [
            'xamples' => Xample::where('teacher_id', '=', $userID)->latest()->paginate(2),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Teacher/Xample/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:70',
            'description' => 'required|string',
            'items' => 'required',
        ]);
        $request->user()->xample()->create($validated);
 
        return redirect(route('teacher.xamples.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Xample $xample)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Xample $xample)
    {
        return Inertia::render('Teacher/Xample/Edit', [
            'xample' => $xample
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Xample $xample): RedirectResponse
    {
        $this->authorize('update', $xample);
 
        $validated = $request->validate([
            'title' => 'required|string|max:70',
            'description' => 'required|string',
            'items' => 'required',
        ]);
 
        $xample->update($validated);
 
        return redirect(route('teacher.xamples.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Xample $xample): RedirectResponse
    {
        $this->authorize('delete', $xample);

        $xample->delete($xample);
 
        return redirect(route('teacher.xamples.index'));
    }
}
