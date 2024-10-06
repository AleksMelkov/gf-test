<?php

declare(strict_types=1);

namespace App\Config\Delivery;

use App\Enums\DeliveryStatusEnum;
use App\Events\DeliveryDelivered;

class DeliveredStatusConfig implements DeliveryStatusConfigInterface
{
    public function getName(): string
    {
        return DeliveryStatusEnum::DELIVERED->value;
    }

    public function acceptedNextStatuses(): array
    {
        return [];
    }

    public function getEventName(): ?string
    {
        return DeliveryDelivered::class;
    }
}
