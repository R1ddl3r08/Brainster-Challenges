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
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Mail\ActivationEmail;
use App\Events\AccountActivated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if(isset($validator)){
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
        }
    
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activation_code' => Str::random(32)
        ]);
    
        event(new Registered($user));
    
        if ($user) {
            $activationUrl = URL::temporarySignedRoute(
                'account.activation',
                now()->addMinutes(1),
                ['email' => $user->email, 'code' => $user->activation_code]
            );
            Event::dispatch(new AccountActivated($user, $activationUrl));
            return response()->json(['message' => 'Account created successfully'], 201);
        }
    
        return response()->json(['message' => 'Something went wrong'], 400);

    }
}
