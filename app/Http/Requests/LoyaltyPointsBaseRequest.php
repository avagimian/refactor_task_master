<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoyaltyPointsBaseRequest extends FormRequest
{
    const ACCOUNT_TYPE = 'account_type';
    const ACCOUNT_ID = 'account_id';
    const DESCRIPTION = 'description';
    const PAYMENT_AMOUNT = 'payment_amount';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::ACCOUNT_TYPE => [
                'required|in:phone,card,email',
            ],

            self::ACCOUNT_ID => [
                'required',
                'int',
            ],

            self::DESCRIPTION => [
                'string',
                'nullable',
            ],

            self::PAYMENT_AMOUNT => [
                'string',
                'nullable',
            ],
        ];
    }

    public function getAccountType()
    {
        return $this->get('account_type');
    }

    public function getAccountId()
    {
        return $this->get('account_id');
    }

    public function getDescription()
    {
        return $this->get('description');
    }

    public function getPaymentAmount()
    {
        return $this->get('payment_amount');
    }
}
