<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Xample;
use App\Models\Group;
use Inertia\Inertia;
use Illuminate\Support\bigInteger;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $userxamples = $user->xamples()->get();

        $userxamples = $userxamples->map(function ($record) {
            return ['id' => $record->id, 'title' => $record->title ];
          });
        
        if($user->group_id > 0) {
            $groupxamples = Group::find($user->group_id)->xamples()->get();
            $groupxamples = $groupxamples->map(function ($record) {
                return ['id' => $record->id, 'title' => $record->title ];
            });
            $xamples = $groupxamples->concat($userxamples);
        } else
        $xamples = $userxamples;

        $xamples = $xamples->unique();


        return Inertia::render('Dashboard', [
            'userxamples' => $xamples,
        ]);
    }

    /**
     * Show the Xample.
     */
    public function showXample(Xample $xample)
    {
        //dd($xample);
        //$xample = Xample::first($id);
        return Inertia::render('Xample', [
            'xample' => $xample
        ]);
    }
}
