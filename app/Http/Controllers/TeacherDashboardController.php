<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Inertia\Inertia;

class TeacherDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $students = User::where('teacher_id', Auth::user()->id)->get();
        $newstudents = User::where('teacher_id', Auth::user()->id)->where('group_id', '=', '')->withCount('xamples')->has('xamples', '=', 0)->get();
        
        return Inertia::render('Teacher/Dashboard', [
            'students' => $students,
            'newstudents' => $newstudents,
        ]);
    }
}
