<?php

namespace App\Http\Middleware;

use App\TokenUser;
use Closure;

class APIToken
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
        $access_token = $request->query('token_key');
        if($access_token){
            $verify = TokenUser::where('token', $access_token)->first();
            if($verify){
                return $next($request);
            }
        }
        return response()->json(['error'=>'Unauthorised'], 401); 
    }
}