<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EnsureSecretKeyIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if user is not auth, check of x-api-key token
        dd($request->header('secret_key'), env('SECRET_KEY'), $request->header('secret_key') === env('SECRET_KEY'));
        if ($request->header('secret_key') === env('SECRET_KEY')) {
            return $next($request);
        }

        return response()->json(['message' => 'Not Allowed'], 403);

    }
}
