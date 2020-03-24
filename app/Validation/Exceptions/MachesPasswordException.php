<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class MachesPasswordException extends ValidationException
{
    public static $defaultTemplates = [
            self::MODE_DEFAULT => [
              self::STANDARD => 'Password Does Not Match.',
            ],
    ];

}