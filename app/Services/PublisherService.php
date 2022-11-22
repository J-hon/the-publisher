<?php

namespace App\Services;

use App\Jobs\PublishMessageJob;
use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Redis;

class PublisherService
{

    protected Connection $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function publish(string $topic, mixed $message): bool
    {
        $subscribers = $this->redis->lRange($topic, 0, -1);
        PublishMessageJob::dispatch($subscribers, $topic, $message);

        return true;
    }

}
