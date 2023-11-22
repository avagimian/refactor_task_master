<?php

namespace App\Providers;

use App\Repositories\Read\LoyaltyAccount\LoyaltyAccountReadRepository;
use App\Repositories\Read\LoyaltyAccount\LoyaltyAccountReadRepositoryInterface;
use App\Repositories\Read\LoyaltyPointsTransaction\LoyaltyPointsTransactionReadRepository;
use App\Repositories\Read\LoyaltyPointsTransaction\LoyaltyPointsTransactionReadRepositoryInterface;

class RepositoriesServiceProvider extends AppServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            LoyaltyAccountReadRepositoryInterface::class,
            LoyaltyAccountReadRepository::class
        );

        $this->app->bind(
            LoyaltyPointsTransactionReadRepositoryInterface::class,
            LoyaltyPointsTransactionReadRepository::class
        );
    }
}
