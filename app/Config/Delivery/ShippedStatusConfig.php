<?php

declare(strict_types=1);

namespace App\Config\Delivery;

use App\Enums\DeliveryStatusEnum;

class ShippedStatusConfig implements DeliveryStatusConfigInterface
{
    public function getName(): string
    {
        return DeliveryStatusEnum::SHIPPED->value;
    }

    public function acceptedNextStatuses(): array
    {
        return [
            DeliveryStatusEnum::DELIVERED->value,
        ];
    }

    public function getEventName(): ?string
    {
        return null;
    }
}
