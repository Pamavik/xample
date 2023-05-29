<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
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
    public function create(string $invite = ''): Response
    {
        $teacher = User::find($invite);
        $group = Group::find($invite);
        if (!$teacher and !$group) {
            $invite = '';
        }
        return Inertia::render('Auth/Register', [
            'invite' => $invite,
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
            'invite' => ['ulid'],
        ]);

        $teacher = User::find($request->invite);
        if (isset($teacher)) {
            $teacher_id = $request->invite;
        } else {
            $teacher_id = '';
        }
        $group = Group::find($request->invite);
        if (isset($group)) {
            $group_id = $request->invite;
            $teacher_id = $group->teacher_id;
        } else {
            $group_id = '';
        }
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'role' => $request->role,
            'email' => $request->email,
            'teacher_id' => $teacher_id,
            'group_id' => $group_id,
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
