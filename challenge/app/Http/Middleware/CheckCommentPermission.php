<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CheckCommentPermission
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

        $commentId = $request->route('id');
        $comment = Comment::find($commentId);

        if($comment && $comment->user_id == Auth::user()->id) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
