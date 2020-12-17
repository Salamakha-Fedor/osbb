<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ClientRepository;
use App\Http\Requests\PostClientRequest;
use Illuminate\Http\Request;

class ClientController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $clientData = $request->all();
        try {
            PostClientRequest::validateClient($clientData);
            $client = ClientRepository::createClient($clientData);
            return $this->success(
                [
                    'client' => $client,
                    'message' => __('Client created successfully')
                ],
                200
            );
        } catch (\Exception $exception) {
            return $this->failure($exception->getMessage(), $exception->getCode());
        }
    }
}
