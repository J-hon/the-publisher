<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class PublishMessageJob implements ShouldQueue
{

    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected array $subscribers, protected string $topic, protected string $message)
    {
    }

    public function handle(): void
    {
        foreach ($this->subscribers as $subscriber) {
            Http::post($subscriber, [
                'topic' => $this->topic,
                'data'  => $this->message
            ]);
         }
    }
}
