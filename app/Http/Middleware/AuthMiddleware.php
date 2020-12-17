<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Response;

class AuthMiddleware
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

        $token = $request->header('Authorization');

        if(!$token) {
            return response()->json(['message' => 'Token not provided' ], 401); 
        }

        $user = User::where('api_token', $token)->first();

        if(!$user) {
            return response()->json(['message' => 'Token not found' ], 404); 
        }

        return $next($request);
    }
}
