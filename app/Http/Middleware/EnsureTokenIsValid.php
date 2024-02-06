<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        // if user is not auth, check of x-api-key token
        if ($request->header('x-api-key')) {
            $token = PersonalAccessToken::where('token', $request->header('x-api-key'))->first();
            if ($token) {

                return $next($request);
            }
        }

        return response()->json(['message' => 'Unauthorized'], 401);

    }
}
