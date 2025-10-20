<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettlementsApiTest extends TestCase
{
    use RefreshDatabase;
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_returns_a_list_of_settlements()
    {
        // When: lekérjük az endpointot
        $response = $this->getJson('/api/settlements');

        // Then: 200-as státuszkódot várunk
        $response->assertStatus(200);

        // És ellenőrizzük a JSON szerkezetét
        $response->assertJsonStructure([
            'settlements' => [
                '*' => [
                    'id',
                    'code',
                    'name',
                    'county_id',
                    'county' => [
                        'id',
                        'name'
                    ]
                ]
            ]
        ]);
    }
}
