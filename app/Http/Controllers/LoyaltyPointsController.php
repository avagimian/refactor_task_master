<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelRequest;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\WithdrawRequest;
use App\Services\Cancel\Actions\CancelAction;
use App\Services\Cancel\Dto\CancelDto;
use App\Services\Deposit\Actions\DepositAction;
use App\Services\Deposit\Dto\DepositDto;
use App\Services\Withdraw\Actions\WithdrawAction;
use App\Services\Withdraw\Dto\WithdrawDto;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoyaltyPointsController extends Controller
{
    /**
     * @throws UnknownProperties
     */
    public function deposit(DepositRequest $request, DepositAction $depositAction)
    {
        // использовал DTO для упрощения передачи информации
        $dto = DepositDto::fromRequest($request);

        // следуя по принципам MVC, контроллер управляет запросами, не вникая в бизнес-логику или работу с данными, для этого использую Service/Action-ы
        return $depositAction->run($dto);
    }

    /**
     * @throws UnknownProperties
     */
    public function cancel(CancelRequest $request, CancelAction $cancelAction): ?JsonResponse
    {
        // использовал DTO для упрощения передачи информации
        $dto = CancelDto::fromRequest($request);

        // следуя по принципам MVC, контроллер управляет запросами, не вникая в бизнес-логику или работу с данными, для этого использую Service/Action-ы
        return $cancelAction->run($dto);
    }

    /**
     * @throws UnknownProperties
     */
    public function withdraw(WithdrawRequest $request, WithdrawAction $withdrawAction)
    {
        // использовал DTO для упрощения передачи информации
        $dto = WithdrawDto::fromRequest($request);

        // следуя по принципам MVC, контроллер управляет запросами, не вникая в бизнес-логику или работу с данными, для этого использую Service/Action-ы
        return $withdrawAction->run($dto);
    }
}
