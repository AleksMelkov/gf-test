<?php

declare(strict_types=1);

namespace App\Config\Delivery;

use App\Enums\DeliveryStatusEnum;

class PlannedStatusConfig implements DeliveryStatusConfigInterface
{
    public function getName(): string
    {
        return DeliveryStatusEnum::PLANNED->value;
    }

    public function acceptedNextStatuses(): array
    {
        return [
            DeliveryStatusEnum::SHIPPED->value,
        ];
    }

    public function getEventName(): ?string
    {
        return null;
    }
}
