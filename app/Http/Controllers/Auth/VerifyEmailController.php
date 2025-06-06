<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserVerification;
use App\Traits\ApiResponseTrait;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VerifyEmailController extends Controller
{
    use ApiResponseTrait;

    public function notice()
    {
        return $this->errorResponse('Your email address is not verified.', null, 403);
    }

    /**
     * @OA\Get(
     *     path="/v1/email/verify/{id}/{hash}",
     *     summary="Email Verification",
     *     operationId="verifyEmail",
     *     tags={"Authentication"},
     *     description="Email Verification",
     *     security={ {"bearerToken" : {} }},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id",
     *         required=true,
     *
     *         @OA\Schema(type="number")
     *     ),
     *
     *     @OA\Parameter(
     *         name="hash",
     *         in="path",
     *         description="Hash",
     *         required=true,
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="expires",
     *         in="query",
     *         description="Expires",
     *         required=true,
     *
     *         @OA\Schema(type="number")
     *     ),
     *
     *     @OA\Parameter(
     *         name="signature",
     *         in="query",
     *         description="Signature",
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
     *             @OA\Examples(example="response", value={"status": 200,"message":"Email Successfully verified.", "data": true }, summary="If success, returns email successfully verified message."),
     *         )
     *     ),
     *
     *     @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function verifyEmail(EmailVerificationRequest $request)
    {
        if ($request->hasValidSignature()) {
            $request->fulfill();

            // Add to otp user verified
            (new UserVerification)->upsertUserVerification($request->id);

            return $this->successResponse([], 'Email Successfully verified.');
        }

        return $this->errorResponse('Invalid Email Signature.', null, 401);
    }

    /**
     * @OA\Post(
     *     path="/v1/email/verify/resend",
     *     summary="Resend Email Verification",
     *     operationId="resendVerifyEmail",
     *     tags={"Authentication"},
     *     description="Resend Email Verification",
     *     security={ {"bearerToken" : {} }},
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Examples(example="response", value={"status": 200,"message":"Email Verification resent.", "data": true }, summary="If success, returns email verification resent message."),
     *         )
     *     ),
     *
     *     @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return $this->successResponse([], 'Email Verification resent.');
    }
}
