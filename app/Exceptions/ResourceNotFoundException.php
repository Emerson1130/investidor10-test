<?php

namespace App\Exceptions;

use InvalidArgumentException;

class ResourceNotFoundException extends InvalidArgumentException
{
    public function __construct(string $message = 'Resource not found.')
    {
        $this->message = $message;
        parent::__construct($message);
    }
}
