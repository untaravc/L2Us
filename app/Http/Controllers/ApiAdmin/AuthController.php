<?php

namespace App\Http\Controllers\ApiAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        $user = User::first();
        $token = $user->createToken('admin');

        return ['token' => $token->plainTextToken];
    }

    public function logout(Request $request){
        // revoke one
        $request->user()->currentAccessToken()->delete();

        $this->response['text'] = 'Logged out!';
        return $this->response;
    }

    public function logout_all(Request $request){
        // revoke all
        $request->user()->tokens()->delete();

        $this->response['text'] = 'Logged out all device!';
        return $this->response;
    }

    public function auth(Request $request){
        $user = $request->user();

        $this->response['result'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email'=> $user->email,
        ];
        return $this->response;
    }
}
