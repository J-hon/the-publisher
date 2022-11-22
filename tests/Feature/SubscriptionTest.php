<?php

namespace Tests\Feature;

use Tests\TestCase;

class SubscriptionTest extends TestCase
{

    public function test_url_is_required()
    {
        $params = [];
        $this->postJson('/api/subscribe/tech', $params)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'url' => 'Enter a valid URL'
            ]);
    }

    public function test_can_subscribe()
    {
        $params = [
            'url' => 'http://127.0.0.1:8001/api/test'
        ];

        $this->postJson('/api/subscribe/tech', $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'url'   => 'http://127.0.0.1:8001/api/test',
                    'topic' => 'tech'
                ]
            ]);
    }

}