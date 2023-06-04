<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Xample;
use App\Models\Group;
use Inertia\Inertia;
use Illuminate\Support\bigInteger;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserDashboardController extends Controller
{
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

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
        $xamples = $this->paginate($xamples, env('PERPAGE'))->withPath('dashboard');
        //dd($xamples);

        $group = Group::find($user->group_id);

        return Inertia::render('Dashboard', [
            'userxamples' => $xamples,
            'group' => $group
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
            'xample' => $xample,
            'student_id' => auth()->user()->id
        ]);
    }
}
