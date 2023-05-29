<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Xample;
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
        return Inertia::render('Dashboard', [
            'userxamples' => $userxamples,
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
