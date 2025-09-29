<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class hasMatch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check())
            return response()->redirectToRoute('login');


        $existingMatch = DB::table('walk_matches')
            ->where(function ($query) {
                $query->where('user_id_1', Auth::id())
                    ->orWhere('user_id_2', Auth::id());
            })
            ->where('completed', false)
            ->orderBy('created_at')
            ->first();

        if (is_null($existingMatch))
            return response()->redirectToRoute('welcome');

        return $next($request);
    }
}
