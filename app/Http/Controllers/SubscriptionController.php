<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends BaseController
{

    public function __construct(protected SubscriptionService $subscriptionService)
    {
    }

    public function store(string $topic, SubscriptionRequest $request): JsonResponse
    {
        $response = $this->subscriptionService->subscribe($request->validated(), $topic);
        return $this->responseJson(
            $response['status'],
            $response['code'],
            $response['message'],
            $response['data']
        );
    }
}
