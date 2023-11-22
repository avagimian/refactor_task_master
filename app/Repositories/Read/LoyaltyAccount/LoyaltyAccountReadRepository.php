<?php

namespace App\Repositories\Read\LoyaltyAccount;

use App\Models\LoyaltyAccount;
use Illuminate\Database\Eloquent\Builder;

class LoyaltyAccountReadRepository implements LoyaltyAccountReadRepositoryInterface
{
    private function query(): Builder
    {
        return LoyaltyAccount::query();
    }

    public function getByKey(string $key, string $accountId)
    {
        return $this->query()->where($key, $accountId)->first();
    }
}
