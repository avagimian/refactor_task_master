<?php

namespace App\Http\Requests;

class WithdrawRequest extends LoyaltyPointsBaseRequest
{
    const POINTS_AMOUNT = 'points_amount';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::POINTS_AMOUNT => [
                'required|numeric|min:0',
            ],
        ];
    }

    public function getPointsAmount()
    {
        return $this->get(self::POINTS_AMOUNT);
    }
}
