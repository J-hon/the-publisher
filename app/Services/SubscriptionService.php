<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Illuminate\Redis\Connections\Connection;
use Throwable;

class SubscriptionService
{

    protected Connection $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function subscribe(array $params, string $topic): array
    {
        try {
            $url = $params['url'];

            if ($this->keyExists($topic)) {
                $subscribers = $this->redis->lRange($topic, 0, -1);

                if (!in_array($url, $subscribers)) {
                    $this->addSubscriber($topic, $url);
                }
            }
            else {
                $this->addSubscriber($topic, $url);
            }

            return [
                'status'  => true,
                'message' => 'Subscription successful',
                'code'    => 200,
                'data'    => [
                    'url'   => $url,
                    'topic' => $topic
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

    private function keyExists(string $key): bool
    {
        return $this->redis->exists($key);
    }

    private function addSubscriber($topic, $url): void
    {
        $this->redis->rPush($topic, $url);
    }

}
