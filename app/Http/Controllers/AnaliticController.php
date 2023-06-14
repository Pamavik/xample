<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class AnaliticController extends Controller
{
    public function index()
    {
        return Inertia::render('Analitic', [
            'teachers' => User::where('role', '=', 1)->select('id', 'name', 'surname', 'email')->latest()->get(),
            'students' => User::where('role', '=', 0)->select('id', 'name', 'surname', 'email')->latest()->get()
        ]);
    }
}
