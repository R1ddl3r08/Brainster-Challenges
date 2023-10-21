<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ActivationEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Events\AccountActivated;

class AccountActivationController extends Controller
{
    public function activate(Request $request, $email, $code)
    {
        $user = User::where('email', $email)->first();

        if (!$request->hasValidSignature()) {
            return view('link-expired', ['email' => $email]);
        }

        if ($user->activation_code !== $code) {
            abort(401, 'Unauthorized Access');
        }

        $user->update(['is_active' => true]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('activated', 'Your account has been activated');
    }

    public function generateActivationLink(Request $request, $email)
    {
        $user = User::where('email', $email)->first();
        $newActivationCode = Str::random(32);
        $user->update(['activation_code' => $newActivationCode, 'is_active' => false]);
    
        $activationUrl = URL::temporarySignedRoute('account.activation', now()->addMinutes(1), ['email' => $user->email, 'code' => $newActivationCode]);
        Event::dispatch(new AccountActivated($user, $activationUrl));
    
        return view('link-expired', ['message' => 'A new activation link has been sent to your email.']);
    }
}
