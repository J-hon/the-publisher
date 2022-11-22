<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublishMessageRequest;
use App\Services\PublisherService;
use Illuminate\Http\JsonResponse;

class PublisherController extends Controller
{

    public function __construct(protected PublisherService $publisherService)
    {
    }

    public function store(PublishMessageRequest $request, string $topic): JsonResponse
    {
        $this->publisherService->publish($topic, $request->message);
        return response()->json([
            'topic' => $topic,
            'data'  => $request->message
        ]);
    }

}
