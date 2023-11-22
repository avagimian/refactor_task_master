<?php

namespace App\Services\Deposit\Actions;

use App\Mail\LoyaltyPointsReceived;
use App\Models\LoyaltyPointsTransaction;
use App\Repositories\Read\LoyaltyAccount\LoyaltyAccountReadRepositoryInterface;
use App\Services\Deposit\Dto\DepositDto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;

class DepositAction
{
    private DepositDto $dto;

    public function __construct(
        protected LoyaltyAccountReadRepositoryInterface $loyaltyAccountReadRepository
    ) {
    }

    public function run(DepositDto $dto)
    {
        $this->dto = $dto;

        $this->validateAccountType();
        $account = $this->getLoyaltyAccount();
        $this->validateAccountStatus($account);

        $transaction = LoyaltyPointsTransaction::performPaymentLoyaltyPoints(
            $account->id,
            $this->dto->loyaltyPointsRule,
            $this->dto->description,
            $this->dto->paymentId,
            $this->dto->paymentAmount,
            $this->dto->paymentTime,
        );

        Log::info($transaction);

        if ($account->email != '' && $account->email_notification) {
            Mail::to($account)->send(new LoyaltyPointsReceived($transaction->points_amount, $account->getBalance()));
        }

        if ($account->phone != '' && $account->phone_notification) {
            Log::info('You received' . $transaction->points_amount . 'Your balance' . $account->getBalance());
        }

        return $transaction;
    }

    // приватные функции помогают скрыть технические детали внутри кода, что делает его более понятным и удобным для работы
    private function validateAccountType(): void
    {
        if (!in_array($this->dto->accountType, ['phone', 'card', 'email'])) {
            Log::info('Wrong account type');
            throw new InvalidArgumentException('Wrong account type');
        }
    }

    private function getLoyaltyAccount()
    {
        // использовал repository для управления операциями чтения и записи с БД, он обеспечивает абстракцию от конкретной реализации
        $account = $this->loyaltyAccountReadRepository->getByKey($this->dto->accountType, $this->dto->accountId);

        if (!$account) {
            Log::info('Account not found');
            return response()->json(['message' => 'Account not found'], 400);
        }

        return $account;
    }

    private function validateAccountStatus($account): void
    {
        if (!$account->active) {
            Log::info('Account is not active');
            response()->json(['message' => 'Account is not active'], 400);
        }
    }
}
