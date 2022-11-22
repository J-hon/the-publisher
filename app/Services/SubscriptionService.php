<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Illuminate\Redis\Connections\Connection;

class SubscriptionService
{

    protected Connection $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function subscribe(string $url, string $topic): bool
    {
        if ($this->keyExists($topic)) {
            $subscribers = $this->redis->lRange($topic, 0, -1);

            if (!in_array($url, $subscribers)) {
                $this->addSubscriber($topic, $url);
            }
        }
        else {
            $this->addSubscriber($topic, $url);
        }

        return true;
    }

    private function keyExists(string $key): bool
    {
        return $this->redis->exists($key);
    }

    private function addSubscriber($topic, $url): void
    {
        $this->redis->rPush($topic, $url);
    }

}
