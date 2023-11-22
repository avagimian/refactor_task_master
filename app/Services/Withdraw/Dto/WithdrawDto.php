<?php

namespace App\Services\Withdraw\Dto;

use App\Http\Requests\WithdrawRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class WithdrawDto extends DataTransferObject
{
    public string $accountType;
    public int $accountId;
    public string $pointsAmount;
    public ?string $description;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(WithdrawRequest $request): WithdrawDto
    {
        return new self(
            accountType: $request->getAccountType(),
            accountId: $request->getAccountId(),
            pointsAmount: $request->getPointsAmount(),
            description: $request->getDescription(),
        );
    }
}
