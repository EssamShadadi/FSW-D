<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\tokens;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tokenRequest = $request->header('token');

        // Find the token in the database
        $token = tokens::where('token', $tokenRequest)->first();

        // Check if the token exists
        if ($token) {
            // Assuming `employee()` is a method or relationship that returns the user
            $employee = $token->employee;

            // Check if `employee` exists and attach it to the request
            if ($employee) {
                $request->merge(['user' => $employee]);
                return $next($request);
            }
        }

        // If token is not valid or employee does not exist
        return response()->json(['message' => 'Not allowed action'], 403);
    }
}
