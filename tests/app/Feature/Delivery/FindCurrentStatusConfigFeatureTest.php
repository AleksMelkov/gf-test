<?php

declare(strict_types=1);

namespace App\Tests\app\Feature\Delivery;

use App\Enums\DeliveryStatusEnum;
use App\Feature\Delivery\FindCurrentStatusConfigFeature;
use App\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class FindCurrentStatusConfigFeatureTest extends TestCase
{
    public static function getTestData(): array
    {
        return [
            [DeliveryStatusEnum::PLANNED->value, true],
            [DeliveryStatusEnum::SHIPPED->value, true],
            [DeliveryStatusEnum::DELIVERED->value, true],
            ['someNameStatus', false],
        ];
    }

    #[DataProvider('getTestData')]
    public function testHandle(string $statusName, bool $result): void
    {
        $feature = app(FindCurrentStatusConfigFeature::class);

        $this->assertEquals($feature->handle($statusName)?->getName() === $statusName, $result);
    }
}
