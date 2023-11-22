<?php

namespace App\Services\Cancel\Actions;

use App\Models\LoyaltyPointsTransaction;
use App\Repositories\Read\LoyaltyPointsTransaction\LoyaltyPointsTransactionReadRepositoryInterface;
use App\Services\Cancel\Dto\CancelDto;

class CancelAction
{
    public function __construct(
        protected LoyaltyPointsTransactionReadRepositoryInterface $loyaltyPointsTransactionReadRepository
    ) {
    }

    public function run(CancelDto $dto)
    {
        if (empty($dto->cancellationReason)) {
            return response()->json(['message' => 'Cancellation reason is not specified'], 400);
        }
        // использовал repository для управления операциями чтения и записи с БД, он обеспечивает абстракцию от конкретной реализации
        $transaction = $this->loyaltyPointsTransactionReadRepository->getById($dto->transactionId);

        if ($transaction) {
            $this->cancelTransaction($transaction, $dto->cancellationReason);
        } else {
            return response()->json(['message' => 'Transaction is not found'], 400);
        }
    }

    // приватные функции помогают скрыть технические детали внутри кода, что делает его более понятным и удобным для работы
    private function cancelTransaction(LoyaltyPointsTransaction $transaction, $reason): void
    {
        $transaction->canceled = now()->timestamp;
        $transaction->cancellation_reason = $reason;
        $transaction->save();
    }
}
