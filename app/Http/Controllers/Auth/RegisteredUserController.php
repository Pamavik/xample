<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(string $teacher_id = ''): Response
    {
        $teacher = User::find($teacher_id);
        if (!$teacher) {
            $teacher_id = '';
        }
        return Inertia::render('Auth/Register', [
            'teacher_id' => $teacher_id,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'teacher_id' => ['ulid'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'role' => $request->role,
            'email' => $request->email,
            'teacher_id' => $request->teacher_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if (auth()->user()->role == 'teacher') {
            return redirect(RouteServiceProvider::TEACHER_HOME);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
