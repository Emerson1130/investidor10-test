<?php

namespace App\Exceptions;

use InvalidArgumentException;

class NoPermissionToHandleException extends InvalidArgumentException
{

    public function __construct(string $message = 'No permission to handle.')
    {
        $this->message = $message;
        parent::__construct($message);
    }

}
