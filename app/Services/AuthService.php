<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\UserProvider;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\UserNotLoggedException;

class AuthService
{

    private UserProvider $userProvider;

    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $this->userProvider->retrieveByCredentials(['email' => $request->email]);
        $logged = $this->userProvider->validateCredentials($user, ['password' => $request->password]);

        if (!$logged) {
            throw new InvalidCredentialsException();
        }

        return [
            'token' => $user->createToken($request->email)->plainTextToken,
            'user' => $user
        ];
    }

    public function loggout(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            throw new UserNotLoggedException();
        }

        $user->tokens()->delete();
    }

}
