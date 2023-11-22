<?php

namespace App\Services\Withdraw\Actions;

use App\Models\LoyaltyAccount;
use App\Models\LoyaltyPointsTransaction;
use App\Repositories\Read\LoyaltyAccount\LoyaltyAccountReadRepositoryInterface;
use App\Services\Withdraw\Dto\WithdrawDto;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class WithdrawAction
{
    public function __construct(
        protected LoyaltyAccountReadRepositoryInterface $loyaltyAccountReadRepository
    ) {
    }

    public function run(WithdrawDto $dto)
    {
        if (in_array($dto->accountType, ['phone', 'card', 'email']) && $dto->accountId != '') {
            // использовал repository для управления операциями чтения и записи с БД, он обеспечивает абстракцию от конкретной реализации
            $account = $this->loyaltyAccountReadRepository->getByKey($dto->accountType, $dto->accountId);

            if ($account && $account->active) {
                $this->validateWithdrawalAmount($account, $dto->pointsAmount);

                $transaction = LoyaltyPointsTransaction::withdrawLoyaltyPoints(
                    $account->id,
                    $dto->pointsAmount,
                    $dto->description
                );

                Log::info($transaction);

                return $transaction;
            } else {
                $responseMessage = $account ? 'Account is not active' : 'Account is not found';
                return response()->json(['message' => $responseMessage], 400);
            }
        } else {
            Log::info('Wrong account parameters');
            throw new InvalidArgumentException('Wrong account parameters');
        }
    }

    // приватные функции помогают скрыть технические детали внутри кода, что делает его более понятным и удобным для работы
    private function validateWithdrawalAmount(LoyaltyAccount $account, $pointsAmount): void
    {
        if ($pointsAmount <= 0) {
            Log::info('Wrong loyalty points amount: ' . $pointsAmount);
            throw new InvalidArgumentException('Wrong loyalty points amount');
        }

        if ($account->getBalance() < $pointsAmount) {
            Log::info('Insufficient funds: ' . $pointsAmount);
            throw new InvalidArgumentException('Insufficient funds');
        }
    }
}
