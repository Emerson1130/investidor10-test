<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

class InvalidCredentialsException extends ValidationException
{

    public function __construct(string $message = 'The provided credentials are incorrect.')
    {
        $this->message = $message;
    }

}
