<?php

namespace App\Http\Controllers;

use App\Services\CreateUserAccountTransactionService;
use Illuminate\Http\Request;

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

        $newWithdraw = $this->createUserAccountTransactionService
            ->makeWithdraw(
                $id,
                $accountId,
                $request->get('amount')
            );

        return response($newWithdraw, 201);
    }
}
