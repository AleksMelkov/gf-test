<?php

declare(strict_types=1);

namespace App\Feature\Delivery;

use App\Config\Delivery\DeliveryStatusConfigInterface;
use Illuminate\Container\Container;
use Illuminate\Container\RewindableGenerator;

class FindCurrentStatusConfigFeature
{
    private RewindableGenerator $statusConfigList;

    public function __construct(Container $container)
    {
        $this->statusConfigList = $container->tagged('delivery.statuses');
    }

    public function handle(string $currentStatus): ?DeliveryStatusConfigInterface
    {
        /** @var DeliveryStatusConfigInterface $config */
        foreach ($this->statusConfigList as $config) {
            if ($config->getName() !== $currentStatus) {
                continue;
            }

            return $config;
        }

        return null;
    }
}
