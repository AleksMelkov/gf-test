<?php

namespace App\Config\Delivery;

interface DeliveryStatusConfigInterface
{
    public function getName(): string;

    public function acceptedNextStatuses(): array;

    public function getEventName(): ?string;

    /**
     * TODO: Можно преобразовать интерфейс getEventName из ?string в array и добавлять дополнительные события, такие как
     * назначение водителя к доставке, назначение склада отгрузки, отправка товарных накладных в стороннюю систему и т.д
     */
}
