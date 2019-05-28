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
    public $successStatus = 200;
    private $tokenAPI;

    public function __construct()
    {
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
                        $login = TokenUser::find($user->id);
                        if($login){
                            // Update Token
                            $token_data = [
                                'token'      => $this->tokenAPI,
                                'updated_at' => now()
                            ];
                            $token_success = $login->update($token_data);
                        } else {
                            // Insert new Token
                            $u_token             = new TokenUser;
                            $u_token->user_id    = $user->id;
                            $u_token->token      = $this->tokenAPI;
                            $u_token->created_at = now();
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
