<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()) {

            return $next($request);
        }

        // if user is not auth, check of X-Api-Key token
        if (request('X-Api-Key')) {
            $token = PersonalAccessToken::where('token', request('X-Api-Key'))->first();
            if ($token && $token->is_active) {

                return $next($request);
            }
        }

        return redirect('login');

    }
}
