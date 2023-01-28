<?php

namespace App\Http\Controllers;

use App\Facades\UserServiceFacade;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/user/login",
     *     tags={"Auth"},
     *      summary="Authorize user",
     *
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      example="admin@admin.com",
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      example="password",
     *                  ),
     *
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="User token")
     * )
     */
    public function login(Request $request, UserService $userService)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        return UserServiceFacade::login($credentials);
    }
    /**
     * @OA\Post(
     *     path="/api/user/create",
     *     tags={"Auth"},
     *      summary="Create new user",
     *
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      example="Name",
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      example="test@test.com",
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      example="password",
     *                  ),
     *
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="User token")
     * )
     */
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
