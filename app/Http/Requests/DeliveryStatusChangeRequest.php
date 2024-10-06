<?php

namespace App\Http\Requests;

use App\Enums\DeliveryStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryStatusChangeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'string',
                Rule::in(DeliveryStatusEnum::values()),
            ],
        ];
    }
}
