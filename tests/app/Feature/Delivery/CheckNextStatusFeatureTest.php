<?php

declare(strict_types=1);

namespace App\Tests\app\Feature\Delivery;

use App\Config\Delivery\DeliveredStatusConfig;
use App\Config\Delivery\DeliveryStatusConfigInterface;
use App\Config\Delivery\PlannedStatusConfig;
use App\Config\Delivery\ShippedStatusConfig;
use App\Enums\DeliveryStatusEnum;
use App\Feature\Delivery\CheckNextStatusFeature;
use App\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CheckNextStatusFeatureTest extends TestCase
{
    public static function getTestData(): array
    {
        return [
            [
                app(PlannedStatusConfig::class),
                DeliveryStatusEnum::SHIPPED->value,
                true,
            ],
            [
                app(PlannedStatusConfig::class),
                DeliveryStatusEnum::DELIVERED->value,
                false,
            ],
            [
                app(ShippedStatusConfig::class),
                DeliveryStatusEnum::DELIVERED->value,
                true,
            ],
            [
                app(ShippedStatusConfig::class),
                DeliveryStatusEnum::PLANNED->value,
                false,
            ],
            [
                app(DeliveredStatusConfig::class),
                DeliveryStatusEnum::PLANNED->value,
                false,
            ],
            [
                app(DeliveredStatusConfig::class),
                DeliveryStatusEnum::SHIPPED->value,
                false,
            ],
        ];
    }

    #[DataProvider('getTestData')]
    public function testHandle(DeliveryStatusConfigInterface $statusConfig, string $nextStatus, bool $result): void
    {
        $feature = app(CheckNextStatusFeature::class);

        $this->assertEquals($feature->handle($statusConfig, $nextStatus), $result);
    }
}
