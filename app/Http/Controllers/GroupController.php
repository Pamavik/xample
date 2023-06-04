<?php

namespace App\Http\Controllers;

use App\Models\Xample;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Inertia\Inertia;
use Inertia\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userID = auth()->user()->id;
        return Inertia::render('Teacher/Group/Index', [
            'groups' => Group::where('teacher_id', '=', $userID)->latest()->paginate(env('PERPAGE')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Teacher/Group/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:70',
        ]);
        $id = $request->user()->group()->create($validated)->id;
 
        return redirect(route('teacher.groups.edit', $id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $userID = auth()->user()->id;
        $groupxamples = $group->xamples()->select('xample_id')->get();
        $xamples = [];
        foreach ($groupxamples as $value){
            array_push($xamples, $value->xample_id);
        };
        return Inertia::render('Teacher/Group/Edit', [
            'group' => $group,
            'groupxamples' => $xamples,
            'xamples' => Xample::where('teacher_id', '=', $userID)->select('id', 'title')->latest()->simplePaginate(
                $perPage = env('PERPAGE'), $columns = ['*'], $pageName = 'xamples'
            ),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group): RedirectResponse
    {
        $this->authorize('update', $group);
 
        $validated = $request->validate([
            'title' => 'required|string|max:70',
        ]);
 
        $group->update($validated);

        $xamples = $group->xamples()->get();
        if(count($xamples) > 0) {
        $group->xamples()->detach($xamples);}
        $group->xamples()->attach($request->selectedItems);
 
        return redirect(route('teacher.groups.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group): RedirectResponse
    {
        $this->authorize('delete', $group);

        $group->delete($group);
 
        return redirect(route('teacher.groups.index'));
    }
}
