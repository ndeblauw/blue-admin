<?php

namespace Ndeblauw\BlueAdmin\Exceptions;

use InvalidArgumentException;

class InvalidPathException extends InvalidArgumentException
{
    public function __construct(
        $message = 'The given file path was invalid',
        $code = 400
    ) {
        parent::__construct($message, $code);
    }
}
