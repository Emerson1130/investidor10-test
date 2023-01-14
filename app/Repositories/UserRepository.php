<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class UserRepository implements UserProvider
{

    public function retrieveByCredentials(array $credentials)
    {
        return User::where('email', $credentials['email'])->first();
    }

    public function validateCredentials(?Authenticatable $user, array $credentials)
    {
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return false;
        }

        return true;
    }

    public function retrieveById($identifier)
    {
        //no used
    }

    public function retrieveByToken($identifier, $token)
    {
        //no used
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        //no used
    }

}
