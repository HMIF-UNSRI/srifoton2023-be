<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->view('errors.400', ['exception' => $exception], 400);
        }

        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return response()->view('errors.403', [], 403);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            return response()->view('errors.419', [], 419);
        }

        if ($exception instanceof \ErrorException || $exception instanceof \Throwable) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Internal Server Error'], 500);
            } else {
                if (!auth()->check()) {
                    return redirect()->guest(route('login'));
                }
                return response()->view('errors.500', [], 500);
            }
        }

        if ($exception instanceof \Illuminate\Database\QueryException) {
            return response()->view('errors.503', [], 503);
        }


        return parent::render($request, $exception);
    }
}
