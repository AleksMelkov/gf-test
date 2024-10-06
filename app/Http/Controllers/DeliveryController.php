<?php

namespace App\Http\Controllers;

use App\Exceptions\ChangeDeliveryStatusError;
use App\Exceptions\NotFoundStatusConfigError;
use App\Exceptions\UpdateDeliveryStatusModelError;
use App\Feature\Delivery\DeliveryStatusChangeFeature;
use App\Http\Requests\DeliveryStatusChangeRequest;
use App\Models\Delivery;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class DeliveryController extends Controller
{
    public function __construct(
        private readonly DeliveryStatusChangeFeature $deliveryStatusChangeFeature
    ) {
    }

    public function statusChange(DeliveryStatusChangeRequest $request, Delivery $delivery): ResponseFactory|Application|\Illuminate\Http\Response
    {
        try {
            $this->deliveryStatusChangeFeature->handle($delivery, $request->input('status'));

            return response('', Response::HTTP_OK);
        } catch (ChangeDeliveryStatusError|NotFoundStatusConfigError|UpdateDeliveryStatusModelError $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
