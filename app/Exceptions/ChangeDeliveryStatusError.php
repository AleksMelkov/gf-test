<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class ChangeDeliveryStatusError extends Exception
{
    public function __construct(string $currentStatus, string $nextStatus)
    {
        parent::__construct("Unable to change status from $currentStatus to $nextStatus");
    }
}
