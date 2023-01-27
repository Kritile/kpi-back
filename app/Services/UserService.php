<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @param $cred
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login($cred)
    {
        if(Auth::attempt($cred)){
            $user = User::where('email','=',$cred['email'])->first();

            return response(['token'=>$user->createToken('authToken')->plainTextToken],'200');
        }
        return response('Unauthorized','401');
    }

    /**
     * @param $cred
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register($cred){
        $user = new User();
        $user->fill($cred);
        $user->save();
        return response(['token' => $user->createToken('authToken')->plainTextToken]);
    }
}
