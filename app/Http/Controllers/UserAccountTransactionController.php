<?php

namespace App\Http\Controllers;

use App\Dataset\UserAccountDepositTransactionDataset;
use App\Dataset\UserAccountTransactionDataset;
use App\Dataset\UserAccountWithdrawTransactionDataset;
use App\Models\UserAccountTransaction;
use App\Repositories\UserAccountTransactionRepositoryInterface;
use Illuminate\Http\Request;

class UserAccountTransactionController extends Controller
{

    private UserAccountTransactionRepositoryInterface $userAccountTransactionService;

    public function __construct(UserAccountTransactionRepositoryInterface $userAccountTransactionService)
    {
        $this->userAccountTransactionService = $userAccountTransactionService;
    }

    public function makeDeposit(
        Request $request,
        int $id,
        int $accountId
    ) {

        $transaction = new UserAccountDepositTransactionDataset(
            $id,
            $accountId,
            $request->get('amount')
        );

        $newDeposit = $this->userAccountTransactionService
        ->createNewAccountTransaction($transaction);

        return response($newDeposit, 201);
    }

    public function makeWithdraw(
        Request $request,
        int $id,
        int $accountId
    ) {
        $transaction = new UserAccountWithdrawTransactionDataset(
            $id,
            $accountId,
            $request->get('amount')
        );

        $newWithdraw = $this->userAccountTransactionService
            ->createNewAccountTransaction($transaction);

        return response($newWithdraw, 201);
    }
}
