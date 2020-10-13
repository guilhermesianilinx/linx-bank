<?php

namespace App\Http\Controllers;

use App\Services\CreateUserAccountTransactionService;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserAccountTransactionController extends Controller
{

    private CreateUserAccountTransactionService $createUserAccountTransactionService;

    public function __construct(
        CreateUserAccountTransactionService $createUserAccountTransactionService
    ) {
        $this->createUserAccountTransactionService = $createUserAccountTransactionService;
    }

    public function makeDeposit(
        Request $request,
        int $id,
        int $accountId
    ) {

        $newDeposit = $this->createUserAccountTransactionService
            ->makeDeposit(
                $id,
                $accountId,
                $request->get('amount')
            );

        return response($newDeposit, 201);
    }

    public function makeWithdraw(
        Request $request,
        int $id,
        int $accountId
    ) {

        try {

            $newWithdraw = $this->createUserAccountTransactionService
            ->makeWithdraw(
                $id,
                $accountId,
                $request->get('amount')
            );

            return response($newWithdraw, 201);

        } catch (DomainException $exception) {

            Log::error("ERRO AO REALIZAR SAQUE");
            Log::error($exception);

            return response($exception->getMessage(), 422);
        }
        
    }
}
