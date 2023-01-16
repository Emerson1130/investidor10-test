<?php

namespace App\Exceptions;

use InvalidArgumentException;

class InvalidCredentialsException extends InvalidArgumentException
{

    public function __construct(string $message = 'The provided credentials are incorrect.')
    {
        $this->message = $message;
        parent::__construct($message);
    }

}
