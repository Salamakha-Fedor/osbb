<?php

namespace Tests\Feature;

use App\Claim;
use App\Client;
use Tests\TestCase;

class ClaimTest extends TestCase
{

    public function testClaimListedSuccessfully()
    {
        $this->withoutExceptionHandling();

        $client = factory(Client::class)->create();

        $claims = factory(Claim::class, 2)->create([
           'client_id' => $client->id
        ]);

        $claimsItem = $claims->random();

        $this->json('GET', "api/claim?pageRows=&client_id=$client->id", ['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertJsonCount($claims->count(), 'data.claims.data')
            ->assertJsonStructure([
                "data" => [
                    "claims" => [
                        "data" => [
                            '*' => [
                                'id',
                                'title',
                                'text',
                                'client_id',
                                'client'
                            ]
                        ],
                    ]
                ]
            ])
            ->assertJsonFragment([
                'success' => true,
                'id' => $claimsItem->id,
                'title' => $claimsItem->title,
                'text' => $claimsItem->text,
                'client_id' => $claimsItem->client_id
            ]);
    }

    /**
     *
     * @return void
     */
    public function testClaimCreatedSuccessfully()
    {
        $this->withoutExceptionHandling();

        $claimData = factory(Claim::class)->raw();

        $response = $this->postJson('/api/claim', $claimData);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true,
                'title' => $claimData['title'],
                'text' => $claimData['text'],
                'client_id' => $claimData['client_id'],
                'in_work' => $claimData['in_work']
            ])
            ->assertJsonStructure([
                "data" => [
                    "claim" => [
                        'id',
                        'title',
                        'text',
                        'client_id'
                    ],
                    'message'
                ]
            ]);
    }

    /**
     *
     * @return void
     */
    public function testChangedClaimSuccessfully()
    {
        $this->withoutExceptionHandling();

        $claim = factory(Claim::class)->create();

        $in_work = $claim->in_work ? false : true ;

        $response = $this->patchJson("/api/claim/$claim->id", ['in_work' => $in_work]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true,
                'id' => $claim->id,
                'title' => $claim->title,
                'text' => $claim->text,
                'client_id' => $claim->client_id,
                'in_work' => $in_work
            ])
            ->assertJsonStructure([
                "data" => [
                    "claim" => [
                        'id',
                        'title',
                        'text',
                        'client_id'
                    ],
                    'message'
                ]
            ]);
    }

    public function testValidateException ()
    {
        $client = Client::orderBy('id', 'desc')->first();
        $clientData = factory(Claim::class)->raw([
            'title' => \rand(),
            'client_id' => $client->id + 1
        ]);

        $response = $this->postJson('/api/claim', $clientData, ['Accept' => 'application/json', 'Content-Type' => 'application/json']);

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
