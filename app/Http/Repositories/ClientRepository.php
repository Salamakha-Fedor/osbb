<?php


namespace App\Http\Repositories;


use App\Client;

class ClientRepository
{
    /**
     * @param array $clientData
     * @return Client
     */
    public static function createClient (array $clientData): Client
    {
        return Client::create($clientData);
    }
}
