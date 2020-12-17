<?php


namespace App\Http\Repositories;


use App\Claim;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClaimRepository
{
    const LIMIT_ROWS = 25;

    /**
     * Add new record of claim
     *
     * @param array $claimData
     * @return Claim
     */
    public static function createClaim (array $claimData): Claim
    {
        return Claim::create($claimData);
    }

    /**
     *  Claim list with filter
     *
     * @param $claimData
     * @return LengthAwarePaginator
     */
    public static function getClaimList (array $claimData): LengthAwarePaginator
    {
        return $claims = Claim::select('id', 'title', 'client_id', 'text', 'created_at', 'updated_at')
            ->with('client:id,name,address')
            ->when($claimData['client_id'], function ($query) use ($claimData) {
                $query->where('client_id', $claimData['client_id']);
            })
            ->paginate($claimData['pageRows'] ?? self::LIMIT_ROWS);
    }

    /**
     *  Update part of claim's data
     *
     * @param Claim $claim
     * @param array $claimData
     * @return bool
     */
    public static function updateClaimParams (Claim $claim, array $claimData)
    {
        return $claim->update($claimData);
    }

}
