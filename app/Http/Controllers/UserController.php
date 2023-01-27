<?php

namespace App\Http\Controllers;

use App\Facades\UserServiceFacade;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function login(Request $request, UserService $userService)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        return UserServiceFacade::login($credentials);
    }

    public function register(Request $request,UserService $userService)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        return UserServiceFacade::register($credentials);

    }

    public function checkAuth(Request $request)
    {
        $response = ['authorized' => false];
        $user = auth('sanctum');
        if ($user->check()) {
            $response['authorized'] = true;
            $response['id'] = $user->id();
        }
        return $response;
    }
}
