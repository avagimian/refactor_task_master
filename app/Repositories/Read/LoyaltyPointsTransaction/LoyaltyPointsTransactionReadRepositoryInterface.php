<?php

namespace App\Repositories\Read\LoyaltyPointsTransaction;

interface LoyaltyPointsTransactionReadRepositoryInterface
{
    public function getById(int $transactionId);
}
