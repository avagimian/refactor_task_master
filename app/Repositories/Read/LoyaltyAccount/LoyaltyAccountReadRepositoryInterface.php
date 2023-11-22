<?php

namespace App\Repositories\Read\LoyaltyAccount;

interface LoyaltyAccountReadRepositoryInterface
{
    public function getByKey(string $key, string $accountId);
}
