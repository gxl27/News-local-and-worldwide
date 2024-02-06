<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HasRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if ($request->header('x-api-key-admin')) {
            $token = PersonalAccessToken::where('token', $request->header('x-api-key-admin'))->first();
            if ($token && $token->tokenable->hasRole('admin')) {
                
                return $next($request);
            }
        }

        return response()->json(['message' => 'Unauthorized'], 401);

    }
}
