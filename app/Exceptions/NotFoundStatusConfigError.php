<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class NotFoundStatusConfigError extends Exception
{
    public function __construct(string $statusName)
    {
        parent::__construct("Status with name $statusName not found in list");
    }
}
