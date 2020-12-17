<?php

namespace App\Http\Controllers;

use App\Claim;
use App\Http\Repositories\ClaimRepository;
use App\Http\Requests\GetClaimRequest;
use App\Http\Requests\PatchClaimRequest;
use App\Http\Requests\PostClaimRequest;
use Illuminate\Http\Request;

class ClaimController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $claimData = $request->all();
        try {
            PostClaimRequest::validateClaim($claimData);
            $claim = ClaimRepository::createClaim($claimData);
            return $this->success(
                [
                    'claim' => $claim,
                    'message' => __('Claim added successfully')
                ],
                200);
        } catch (\Exception $exception) {
            return $this->failure($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $claimData = $request->all();
        try {
            GetClaimRequest::validateClaim($claimData);
            $claims = ClaimRepository::getClaimList($claimData);
            $responseData = [
                'claims' => $claims,
            ];
            return $this->success($responseData, 200);
        } catch (\Exception $exception) {
            return $this->failure($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     *  Change some claim's data
     *
     * @param Claim $claim
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeClaim (Claim $claim, Request $request)
    {
        $claimData = $request->all();
        try {
            PatchClaimRequest::validateClaim($claimData);
            ClaimRepository::updateClaimParams($claim, $claimData);
            $responseData = [
                'claim' => $claim,
                'message' => __('Claim changed successfully')
            ];
            return $this->success($responseData, 200);
        } catch (\Exception $exception) {
            return $this->failure($exception->getMessage(), $exception->getCode());
        }
    }
}
