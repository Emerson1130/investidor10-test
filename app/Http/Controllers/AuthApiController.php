<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;
use App\Services\AuthService;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\UserNotLoggedException;
use App\Traits\ApiControllerActions;

class AuthApiController extends Controller
{
    use ApiControllerActions;

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $status = false;
        try {
            $response = $this->authService->login($request);
            $status = true;
            $httpCode = 201;
        } catch (InvalidCredentialsException $exception) {
            $response = ['message' => $exception->getMessage()];
            $httpCode = 401;
        } catch (Throwable $throwable) {
            $response = ['message' => $throwable->getMessage()];
            $httpCode = 500;
        }

        return $this->response($status, $response, $httpCode);
    }

    public function loggout(Request $request)
    {
        $status = false;
        try {
            $this->authService->loggout($request);
            $status = true;
            $httpCode = 200;
            $message = 'Logout performed.';
        } catch (UserNotLoggedException $exception) {
            $message = $exception->getMessage();
            $httpCode = 404;
        } catch (Throwable $throwable) {
            $message = $throwable->getMessage();
            $httpCode = 500;
        }

        return $this->response($status, ['message' => $message], $httpCode);
    }
}
