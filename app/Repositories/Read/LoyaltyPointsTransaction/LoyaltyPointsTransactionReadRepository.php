<?php

namespace App\Repositories\Read\LoyaltyPointsTransaction;

use App\Models\LoyaltyPointsTransaction;
use Illuminate\Database\Eloquent\Builder;

class LoyaltyPointsTransactionReadRepository implements LoyaltyPointsTransactionReadRepositoryInterface
{
    private function query(): Builder
    {
        return LoyaltyPointsTransaction::query();
    }

    public function getById(int $transactionId)
    {
        return $this->query()->where('id', $transactionId)
            ->where('canceled', 0)
            ->first();
    }
}
