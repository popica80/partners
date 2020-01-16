<?php

namespace App\Http\Middleware;

use App\Token;
use App\User;
use Closure;

class CheckToken
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
        $bearerToken = $request->bearerToken();
        if ($bearerToken && $token = Token::with('user')->whereToken($bearerToken)->whereName('auth')->first()) {
            $request->merge(['user' => $token->user]);
            return $next($request);
        }
        return response()->json(['message' => 'Unauthenticated'], 401);
    }
}
