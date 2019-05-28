<?php

namespace App\Http\Middleware;

use App\TokenUser;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

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
        // Check request token_key
        $access_token = $request->query('token_key');
        if($access_token){
            // Check if token_key exist
            $verify = TokenUser::where('token', $access_token)->first();
            if($verify){
                // Get user info
                $user = User::find($verify->user_id);
                // Login user
                Auth::login($user);
                return $next($request);
            }
        }
        return response()->json(['error'=>'Unauthorized'], 401); 
    }
}
