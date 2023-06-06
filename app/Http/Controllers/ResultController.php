<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use Inertia\Inertia;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userID = auth()->user()->id;
        $user_id = $request->user_id;
        $xample_id = $request->xample_id;
        $results = Result::where('teacher_id', '=', $userID)->with('xample:id,title', 'user:id,name,surname')->latest()->when($request->has('user_id'), function ($query) use ($userID, $user_id){
            $query->where('user_id', '=', $user_id);
        })->when($request->has('xample_id'), function ($query) use ($userID, $xample_id){
            $query->where('xample_id', '=', $xample_id);
        })->paginate(env('PERPAGE'))->withQueryString();
//dd($results);
        return Inertia::render('Teacher/Results/Index', [
            'results' => $results,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'xample_id' => 'integer',
            'user_id' => 'ulid',
            'teacher_id' => 'ulid',
            'questions_count' => 'integer',
            'errors_count' => 'integer',
            'errors_list' => 'array',
        ]);
        $user = auth()->user();
        $user->rating = $user->rating + $validated['questions_count'] - $validated['errors_count'];
        $user->save();
        $request->user()->result()->create($validated);
        return redirect(route('dashboard'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
