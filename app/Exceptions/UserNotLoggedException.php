<?php

namespace App\Exceptions;

use RuntimeException;

class UserNotLoggedException extends RuntimeException
{

    public function __construct(string $message = 'User is not logged.')
    {
        $this->message = $message;
        parent::__construct($message);
    }

}
