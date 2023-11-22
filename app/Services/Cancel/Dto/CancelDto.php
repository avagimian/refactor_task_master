<?php

namespace App\Services\Cancel\Dto;

use App\Http\Requests\CancelRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CancelDto extends DataTransferObject
{
    public string $cancellationReason;
    public string $transactionId;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(CancelRequest $request): CancelDto
    {
        return new self(
            cancellationReason: $request->getCancellationReason(),
            transactionId: $request->getTransactionId()
        );
    }
}
