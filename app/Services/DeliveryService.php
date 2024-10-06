<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\DeliveryRepository;
use Illuminate\Database\Eloquent\Model;
use RonasIT\Support\Services\EntityService;

class DeliveryService extends EntityService
{
    public function __construct()
    {
        $this->setRepository(DeliveryRepository::class);
    }

    public function updateStatus(int $deliveryId, string $status): ?Model
    {
        return $this->repository->update(
            ['id' => $deliveryId],
            ['status' => $status],
        );
    }
}
