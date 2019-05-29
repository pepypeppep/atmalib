<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\TokenUser;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Declare token variable
    private $tokenAPI;

    public function __construct()
    {
        // Generate random token
        $this->tokenAPI = uniqid(str_random(10));
    }

    /** 
     * Login API
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request){ 
        // Validation
        $rules = [
            'username'=>'required',
            'password'=>'required|min:8'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages(),
            ]);
        } else {
            // Get User Data
            $user = User::where('username',$request->username)->first();
            if($user) {
                // Verify the password
                if(password_verify($request->password, $user->password)) {
                    if($user->active==1){
                        // Verity token
                        $login = TokenUser::withoutGlobalScope('expired_at')->where('user_id',$user->id)->first();
                        if($login){
                            // Update Token
                            $token_data = [
                                'token'      => $this->tokenAPI,
                                'expired_at' => date("Y-m-d H:i:s",strtotime("+15 minutes", strtotime(now()))),
                                'updated_at' => now()
                            ];
                            $token_success = $login->update($token_data);
                        } else {
                            // Insert new Token
                            $u_token             = new TokenUser;
                            $u_token->user_id    = $user->id;
                            $u_token->token      = $this->tokenAPI;
                            $u_token->created_at = now();
                            $u_token->expired_at = date("Y-m-d H:i:s",strtotime("+15 minutes", strtotime(now())));
                            $token_success = $u_token->save();
                        }
                        // Success login
                        if($token_success) {
                            return response()->json([
                                'username'  => $user->username,
                                'token_key' => $this->tokenAPI,
                            ]);
                        }
                    } else {
                    // Wrong password
                        return response()->json([
                            'message' => 'This account is not active!',
                        ]);
                    }
                } else {
                    // Wrong password
                    return response()->json([
                        'message' => 'Invalid Password!',
                    ]);
                }
            } else {
                // Username not found
                return response()->json([
                    'message' => 'Username not found!',
                ]);
            }
        }
    }
}
