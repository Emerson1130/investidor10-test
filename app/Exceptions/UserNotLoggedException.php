<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

class UserNotLoggedException extends ValidationException
{

    public function __construct(string $message = 'User is not logged.')
    {
        $this->message = $message;
    }

}
