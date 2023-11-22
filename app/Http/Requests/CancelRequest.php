<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelRequest extends FormRequest
{
    const CANCELLATION_REASON = 'cancellation_reason';
    const TRANSACTION_ID = 'transaction_id';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::CANCELLATION_REASON => [
                'required',
                'string',
            ],

            self::TRANSACTION_ID => [
                'required',
                'int',
            ],
        ];
    }

    public function getCancellationReason()
    {
        return $this->get(self::CANCELLATION_REASON);
    }

    public function getTransactionId()
    {
        return $this->get(self::TRANSACTION_ID);
    }
}
