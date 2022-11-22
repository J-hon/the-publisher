<?php

namespace App\Services;

use App\Jobs\PublishMessageJob;
use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Redis;
use Throwable;

class PublisherService
{

    protected Connection $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function publish(string $topic, array $params): array
    {
        try {
            $subscribers = $this->redis->lRange($topic, 0, -1);
            PublishMessageJob::dispatch($subscribers, $topic, $params['message']);

            return [
                'status'  => true,
                'message' => 'Publishing successful',
                'code'    => 200,
                'data'    => [
                    'topic' => $topic,
                    'data'  => $params['message']
                ]
            ];
        }
        catch (Throwable $th) {
            report($th);
            return [
                'status'  => false,
                'message' => 'Oops! An error occurred!',
                'code'    => 400,
                'data'    => []
            ];
        }
    }

}
