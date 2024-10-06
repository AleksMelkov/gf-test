<?php

declare(strict_types=1);

namespace App\Feature\Delivery;

use App\Exceptions\ChangeDeliveryStatusError;
use App\Exceptions\NotFoundStatusConfigError;
use App\Exceptions\UpdateDeliveryStatusModelError;
use App\Models\Delivery;
use App\Services\DeliveryService;
use Illuminate\Support\Facades\Event;

class DeliveryStatusChangeFeature
{
    public function __construct(
        private readonly CheckNextStatusFeature $checkNextStatusFeature,
        private readonly FindCurrentStatusConfigFeature $findCurrentStatusConfigFeature,
        private readonly DeliveryService $deliveryService,
    ) {
    }

    public function handle(Delivery $delivery, string $statusName): void
    {
        // Ищем конфиг для текущего статуса заказа
        $statusConfig = $this->findCurrentStatusConfigFeature->handle($delivery->status);

        if ($statusConfig === null) {
            throw new NotFoundStatusConfigError($delivery->status);
        }

        // Проверяем, можем ли мы изменять текущий статус на тот, что пришел из вне
        if (!$this->checkNextStatusFeature->handle($statusConfig, $statusName)) {
            throw new ChangeDeliveryStatusError($delivery->status, $statusName);
        }

        // Обновляем статус в хранилище
        $deliveryModel = $this->deliveryService->updateStatus($delivery->id, $statusName);
        if ($deliveryModel === null) {
            throw new UpdateDeliveryStatusModelError("Failed to update model with ID {$delivery->id}");
        }

        // Запускаем событие на уведомление пользователя, если такое событие предусмотрено конфигом статуса
        /** @var Event $eventClass */
        if ($eventClass = $statusConfig->getEventName()) {
            $eventClass::dispatch($deliveryModel);
        }
    }
}
