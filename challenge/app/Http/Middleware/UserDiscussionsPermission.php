<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserDiscussionsPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->is_admin == true){
            return $next($request);
        }

        $userId = $request->route('id');
        $user = User::find($userId);

        if($user && $user->id == Auth::user()->id) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
