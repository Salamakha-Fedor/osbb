<?php

namespace Tests\Feature;

use App\Client;
use App\Exceptions\BadRequestParamsException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ClientTest extends TestCase
{

    /**
     *
     * @return void
     */
    public function testClientCreatedSuccessfully()
    {
        $this->withoutExceptionHandling();

        $clientData = factory(Client::class)->raw();

        $response = $this->postJson('/api/client', $clientData);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true,
                'name' => $clientData['name'],
                'address' => $clientData['address'],
            ])
            ->assertJsonStructure([
                "data" => [
                    "client" => [
                        'name',
                        'address',
                    ],
                ]
            ]);
    }

    public function testValidateException ()
    {
        $clientData = factory(Client::class)->raw([
            'name' => Str::random(201)
        ]);

        $response = $this->postJson('/api/client', $clientData, ['Accept' => 'application/json', 'Content-Type' => 'application/json']);

        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'error' => [
                    'message'
                ]
            ])
            ->assertJsonFragment(['success' => false]);
    }
}
