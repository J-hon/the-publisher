<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublishMessageRequest;
use App\Services\PublisherService;
use Illuminate\Http\JsonResponse;

class PublisherController extends BaseController
{

    public function __construct(protected PublisherService $publisherService)
    {
    }

    public function store(PublishMessageRequest $request, $topic): JsonResponse
    {
        $response = $this->publisherService->publish($topic, $request->validated());
        return $this->responseJson(
            $response['status'],
            $response['code'],
            $response['message'],
            $response['data']
        );
    }

}
