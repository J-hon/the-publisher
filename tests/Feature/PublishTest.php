<?php

namespace Tests\Feature;

use App\Jobs\PublishMessageJob;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class PublishTest extends TestCase
{

    public function test_message_is_required()
    {
        $params = [];
        $this->postJson('/api/publish/tech', $params)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'message' => 'The message field is required.'
            ]);
    }

    public function test_can_publish()
    {
        $params = [
            'message' => [
                'key' => 'value'
            ]
        ];

        Queue::fake();

        $this->postJson('/api/publish/tech', $params)
            ->assertStatus(200)
            ->assertJson([
                'topic' => 'tech',
                'data'  => [
                    'key' => 'value'
                ]
            ]);

        Queue::assertPushed(PublishMessageJob::class);

    }

}
