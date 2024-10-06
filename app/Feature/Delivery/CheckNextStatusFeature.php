<?php

declare(strict_types=1);

namespace App\Feature\Delivery;

use App\Config\Delivery\DeliveryStatusConfigInterface;

class CheckNextStatusFeature
{
    public function handle(DeliveryStatusConfigInterface $statusConfig, string $nextStatus): bool
    {
        return in_array($nextStatus, $statusConfig->acceptedNextStatuses(), true);
    }
}
