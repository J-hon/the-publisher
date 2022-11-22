<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{

    public function __construct(protected SubscriptionService $subscriptionService)
    {
    }

    public function store(string $topic, SubscriptionRequest $request): JsonResponse
    {
        $this->subscriptionService->subscribe($request->url, $topic);
        return response()->json([
            'url'   => $request->url,
            'topic' => $topic
        ]);
    }
}
