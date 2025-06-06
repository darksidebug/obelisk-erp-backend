<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    /**
     * @OA\Post(
     *     path="/v1/auth/password/email",
     *     summary="Send Reset Password Link",
     *     operationId="sendResetPasswordLink",
     *     tags={"Authentication"},
     *     description="Send Reset Password Link",
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
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Examples(example="response", value={"status": 200,"message":"Password reset link successfully sent.", "data": true }, summary="If success, returns email successfully sent password reset link message."),
     *         )
     *     ),
     *
     *     @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'exists:users,email']], ['email.exists' => "The email entered doesn't exists."]);

        // Store user type in session to be used in the notification
        session(['user_reset_type' => $request->type ?? 'admin']);

        $response = Password::sendResetLink($request->only('email'));

        session()->forget('user_reset_type');

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['message' => __($response)])
            : response()->json(['error' => __($response)], 400);
    }

    /**
     * @OA\Post(
     *     path="/v1/auth/password/reset",
     *     summary="Reset Password",
     *     operationId="resetPassword",
     *     tags={"Authentication"},
     *     description="Reset Password",
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
     *     @OA\Parameter(
     *         name="token",
     *         in="query",
     *         description="Token",
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
     *     @OA\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         description="Password Confirm",
     *         required=true,
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Examples(example="response", value={"status": 200,"message":"Password successfully reset.", "data": true }, summary="If success, returns password successfully reset message."),
     *         )
     *     ),
     *
     *     @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $response == Password::PASSWORD_RESET
            ? response()->json(['message' => __($response)])
            : response()->json(['error' => __($response)], 400);
    }
}
