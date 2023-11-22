<?php

namespace App\Http\Requests;

class DepositRequest extends LoyaltyPointsBaseRequest
{
    const LOYALTY_POINTS_RULE = 'loyalty_points_rule';
    const PAYMENT_ID = 'payment_id';
    const PAYMENT_TIME = 'payment_time';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::LOYALTY_POINTS_RULE => [
                'string',
                'nullable',
            ],

            self::PAYMENT_ID => [
                'int',
                'nullable',
            ],

            self::PAYMENT_TIME => [
                'string',
                'nullable',
            ],
        ];
    }

    public function getLoyaltyPointsRule()
    {
        return $this->get('loyalty_points_rule');
    }

    public function getPaymentId()
    {
        return $this->get('payment_id');
    }

    public function getPaymentTime()
    {
        return $this->get('payment_time');
    }
}
