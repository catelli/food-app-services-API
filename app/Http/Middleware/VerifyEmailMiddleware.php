<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Response;

class VerifyEmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $email = $request->email;
        $user = User::where('email', $email)->first();


        if(!$user) {
            return response()->json(['message' => 'User not found' ], 404); 
        }

        if(\is_null($user->email_verified_at)) {
            return response()->json(['message' => 'Check email to continue'], 401);
        }

        return $next($request);
    }
}
