<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum DeliveryStatusEnum: string
{
    use EnumTrait;

    case PLANNED = 'planned'; // запланирован

    case SHIPPED = 'shipped'; // отгружен/в пути

    case DELIVERED = 'delivered'; // доставлен
}
