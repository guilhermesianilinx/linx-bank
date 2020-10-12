<?php

namespace App\Services;

use App\Dataset\UserAccountDepositTransactionDataset;
use App\Repositories\UserAccountTransactionRepositoryInterface;

class CreateUserAccountTransactionService
{

    private UserAccountTransactionRepositoryInterface $userAccountTransactionRepository;

    public function __construct(
        UserAccountTransactionRepositoryInterface $userAccountTransactionRepository
    ) {
        $this->userAccountTransactionRepository = $userAccountTransactionRepository;
    }

    public function makeDeposit(
        int $userId,
        int $accountId,
        int $depositAmount
    ): array {

        $transaction = new UserAccountDepositTransactionDataset(
            $userId,
            $accountId,
            $depositAmount
        );

        return $this->userAccountTransactionRepository
            ->createNewAccountTransaction($transaction);
    }

    public function makeWithdraw(
        int $userId,
        int $accountId,
        int $depositAmount
    ): array {

        $transaction = new UserAccountDepositTransactionDataset(
            $userId,
            $accountId,
            $depositAmount
        );

        return $this->userAccountTransactionRepository
            ->createNewAccountTransaction($transaction);
    }
}
