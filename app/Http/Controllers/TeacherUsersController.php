<?php

namespace App\Http\Controllers;

use App\Models\Xample;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TeacherUsersController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $userID = auth()->user()->id;
        return Inertia::render('Teacher/Users/Index', [
            'users' => User::where('teacher_id', '=', $userID)->latest()->get(),
        ]);
    }

    /**
     * Display the user resource.
     */

    public function showUser(Request $request)
    {
        $userID = auth()->user()->id;
        $user = User::find($request->user_id);
        $userxamples = $user->xamples()->select('xample_id')->get();
        $xamples = [];
        foreach ($userxamples as $value){
            array_push($xamples, $value->xample_id);
        };
        return Inertia::render('Teacher/Users/Show', [
            'user' => $user,
            'userxamples' => $xamples,
            'xamples' => Xample::where('teacher_id', '=', $userID)->latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUser(Request $request): RedirectResponse
    {
        $user = User::find($request->user['id']);
        $xamples = $user->xamples()->get();
        if(count($xamples) > 0) {
        $user->xamples()->detach($xamples);}
        //dd($request->selectedItems);
        $user->xamples()->attach($request->selectedItems);
        //$xample->update($validated);
 
        return redirect(route('teacher.users'));
    }
}
