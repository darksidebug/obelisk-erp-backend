<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UserVerificationHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerification;
use App\Models\VerificationCode;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class VerifyOtpController extends Controller
{
    use ApiResponseTrait;

    /**
     * @OA\Post(
     *     path="/v1/otp/verify",
     *     summary="OTP Verification",
     *     operationId="verifyOTP",
     *     tags={"Authentication"},
     *     description="OTP Verification",
     *     security={ {"bearerToken" : {} }},
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="User ID",
     *         required=true,
     *
     *         @OA\Schema(type="number")
     *     ),
     *
     *     @OA\Parameter(
     *         name="otp",
     *         in="query",
     *         description="OTP",
     *         required=true,
     *
     *         @OA\Schema(type="number")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Examples(example="response", value={"status": 200,"message":"OTP Successfully verified.", "data": true }, summary="If success, returns otp successfully verified message."),
     *         )
     *     ),
     *
     *     @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function verify(Request $request)
    {
        $verify = VerificationCode::whereUserId($request->user_id)
            ->where('otp', $request->otp);
        if (! $verify->exists()) {
            return $this->errorResponse('Invalid OTP.', null, 417);
        }
        $verify = $verify->first();
        if ($verify->expire_at < now()) {
            return $this->errorResponse('OTP Expires.', null, 417);
        }
        // Update OTP Status
        $verify?->update(['status' => VerificationCode::STATUS_USED]);
        $verify?->delete();

        (new UserVerification)->upsertUserVerification($request->user_id);

        return $this->successResponse([], 'OTP Successfully verified');
    }

    /**
     * @OA\Get(
     *     path="/v1/otp/resend/{id}",
     *     summary="OTP Resend",
     *     operationId="resendOTP",
     *     tags={"Authentication"},
     *     description="OTP Resend",
     *     security={ {"bearerToken" : {} }},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *
     *         @OA\Schema(type="number")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Examples(example="response", value={"status": 200,"message":"OTP Successfully resent.", "data": true }, summary="If success, returns otp successfully resent message."),
     *         )
     *     ),
     *
     *     @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function resend($id)
    {
        $user = User::findOrFail($id);
        $userVerification = (new UserVerificationHelper)->run($user);
        if ($userVerification) {
            return $this->successResponse([], 'OTP Successfully resent');
        }

        return $this->errorResponse('No OTP required', null, 417);
    }
}
