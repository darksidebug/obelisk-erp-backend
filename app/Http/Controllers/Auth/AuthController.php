<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerification;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/v1/auth/register",
     *     summary="Register and authenticate client user",
     *     operationId="register",
     *     tags={"Authentication"},
     *     description="Register Client User",
     *
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email",
     *         required=true,
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *    @OA\Parameter(
     *         name="first_name",
     *         in="query",
     *         description="First Name",
     *         required=true,
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="last_name",
     *         in="query",
     *         description="Last Name",
     *         required=true,
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Password",
     *         required=true,
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(response="200", description="Register successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function register(Request $request)
    {
        
    }

    /**
     * @OA\Post(
     *     path="/v1/auth/login",
     *     summary="Authenticate user and generate JWT token",
     *     operationId="login",
     *     tags={"Authentication"},
     *     description="Returns login authentication",
     *
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email",
     *         required=true,
     *         example="test@example.com",
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Password",
     *         required=true,
     *         example="password",
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function login(Request $request)
    {   
        try {
            $credentials = $request->only('email', 'password');

            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $user = Auth::user();
            $userAccount = $this->getUserAccount($user);

            return response()->json([
                'status' => 'success',
                'user' => $userAccount,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],
            ]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

    }

    /**
     * @OA\Post(
     *     path="/v1/auth/logout",
     *     summary="Logout the authenticated user",
     *     operationId="logout",
     *     tags={"Authentication"},
     *     description="Returns logout message",
     *
     *     @OA\Response(response="200", description="Log-out successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/v1/auth/refresh",
     *     summary="Refresh or regenerate JWT token",
     *     operationId="refreshToken",
     *     tags={"Authentication"},
     *     description="Returns login authentication",
     *     security={ {"bearerToken" : {} }},
     *
     *     @OA\Response(response="200", description="Refresh token successful"),
     *     @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::guard('api')->user(),
            'authorization' => [
                'token' => Auth::guard('api')->refresh(),
                'type' => 'bearer',
            ],
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

    private function getUserAccount($user)
    {
        // $user = User::whereId($user->id)->with(['client' => function ( $subQuery ) {
        //     $subQuery->select('id','user_id', 'gender', 'birth_date');
        //     $subQuery->with('client_addresses');
        // }])->first();
        $user = User::whereId($user->id)->first();

        // $fileHelper = new FileHelper();
        // $user['avatar'] = $fileHelper->checkFileExists($user?->avatar ?? 'no-file-default-string.pdf') ? $fileHelper->getPublicUrl($user?->avatar) : $user->avatar;
        return $user;
    }
}
