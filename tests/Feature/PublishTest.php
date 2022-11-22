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

    public function test_message_must_be_array_or_object()
    {
        $params = [
            'message' => 'Publish message'
        ];

        $this->postJson('/api/publish/tech', $params)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'message' => 'Message must be an array or an object.'
            ]);
    }

    public function test_can_publish()
    {
        Queue::fake();

        $message = [
            'key' => 'value'
        ];

        $params = [
            'message' => $message
        ];

        $this->postJson('/api/publish/tech', $params)
            ->assertStatus(200)
            ->assertJson([
                'topic' => 'tech',
                'data'  => $message
            ]);

        Queue::assertPushed(PublishMessageJob::class);
    }

}
