<?php


use App\Http\Middleware\CorsMiddleware;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'v1',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(CorsMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (UnauthorizedException $e) {
            return response()->json([
                'status' => 403,
                'message' => 'Forbidden',
                'data' => [],
            ], 403);
        });

        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
                'data' => [],
            ], 404);
        });

        $exceptions->render(function (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
                'data' => [],
            ], 404);
        });

        $exceptions->render(function (Request $request) {
            if ( $request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail() ) {
                return response()->json([
                    'status' => 403,
                    'message' => 'Your email address is not verified.',
                    'data' => [],
                ], 404);
            }
        });

        $exceptions->render(function (AccessDeniedHttpException $e) {
            return response()->json([
                'status' => 403,
                'message' => $e->getMessage(),
                'data' => [],
            ], 403);
        });
    })->create();
