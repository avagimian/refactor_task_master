<?php

namespace App\Services\Deposit\Dto;

use App\Http\Requests\DepositRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class DepositDto extends DataTransferObject
{
    public string $accountType;
    public int $accountId;
    public ?string $loyaltyPointsRule;
    public ?string $description;
    public ?int $paymentId;
    public ?string $paymentAmount;
    public ?string $paymentTime;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(DepositRequest $request): DepositDto
    {
        return new self(
            accountType: $request->getAccountType(),
            accountId: $request->getAccountId(),
            loyaltyPointsRule: $request->getLoyaltyPointsRule(),
            description: $request->getDescription(),
            paymentId: $request->getPaymentId(),
            paymentAmount: $request->getPaymentAmount(),
            paymentTime: $request->getPaymentTime(),
        );
    }
}
