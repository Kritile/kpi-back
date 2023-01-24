<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $user = User::where('email','=',$credentials['email'])->first();

            return response(['token'=>$user->createToken('authToken')->plainTextToken],'200');
        }
        return response('Unauthorized','401');
    }

    public function register(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = new User();
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = $credentials['password'];
        $user->save();
        return response(['token'=> $user->createToken('authToken')->plainTextToken]);
    }
    public function checkAuth(Request $request) {
        $response = ['authorized' => false];
        $user = auth('sanctum');
        if($user->check()){
            $response['authorized'] = true;
            $response['id'] = $user->id();
        }
        return $response;
    }
}
