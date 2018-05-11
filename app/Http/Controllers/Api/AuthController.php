<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = $this->jwtAuth->attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $user = $this->jwtAuth->authenticate($token);
        return response()->json(compact('token','user'));
    }

    public function refresh(){
        $token =  $this->jwtAuth->getToken();
        $token = $this->jwtAuth->refresh($token);
        return response()->json(compact('token'));
    }

    public function logout(){
        $token = $this->jwtAuth->getToken();
        $this->jwtAuth->invalidate($token);
        return response()->json(['logout']);
    }

    public function me()
    {
        if (!$user = $this->jwtAuth->parseToken()->authenticate()) {
            return response()->json(['error'=>'user_not_found'], 404);
        }
        return response()->json(compact('user'));
    }

    public function updateUser(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');

        $user = $this->jwtAuth->parseToken()->authenticate();
        $id = $user->id;
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id
        ];
        $validator = \Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }

        //return response()->json($user);

        if($request->password != ""){
            User::where('id', '=', $user->id)->update(array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ));
        }
        User::where('id', '=', $user->id)->update(array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ));

        return response()->json(['success'=> true, 'done'=>'Updated Successfully']);

    }


}
