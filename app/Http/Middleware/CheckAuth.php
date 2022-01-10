<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Facades\DB;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        // return $next($request);
        $token_h = $request->header('token');
        if (isset($token_h)) {
            try {
            $token = Token::where('token', $token_h)
                ->where('created_at', '>', DB::raw('now() - INTERVAL 5 HOUR'))
                ->orderBy('id', 'desc')
                ->take(1)
                ->get();
                // return response($token);
            } catch (\Exception $e) {
                return response(json_encode([ 'error' => true, 'code' => 100, 'message' => 'Authentification failed.' ]), 403)
                    ->header('Content-Type', 'application/json');
            }
            if($token->isEmpty()) {
                return response(json_encode([ 'error' => true, 'code' => 101, 'message' => 'Token not valid.' ]),403);
            }
        } else {
            return response(json_encode([ 'error' => true, 'code' => 102, 'message' => 'Token not provided.' ]),403);
        }
        return $next($request);
    }
}
