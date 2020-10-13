<?php

namespace App\Services;

use App\Dataset\UserAccount\UserAccountCheckingDataset;
use App\Dataset\UserAccount\UserAccountSavingsDataset;
use App\Dataset\UserAccountDepositTransactionDataset;
use App\Repositories\UserAccountRepositoryInterface;
use App\Repositories\UserAccountTransactionRepositoryInterface;

class CreateUserAccountService
{

    private UserAccountRepositoryInterface $userAccountRepository;
    private UserAccountTransactionRepositoryInterface $userAccountTransactionRepository;
    private CreateUserAccountTransactionService $createUserAccountTransactionService;

    public function __construct(
        UserAccountRepositoryInterface $userAccountRepository,
        UserAccountTransactionRepositoryInterface $userAccountTransactionRepository,
        CreateUserAccountTransactionService $createUserAccountTransactionService
    ) {
        $this->userAccountRepository = $userAccountRepository;
        $this->userAccountTransactionRepository = $userAccountTransactionRepository;
        $this->createUserAccountTransactionService = $createUserAccountTransactionService;
    }

    public function createSavingsAccountWithBalance(
        int $userId,
        int $initialBalance
    ): array {

        $account = $this->userAccountRepository->createNewUserAccount(
            new UserAccountSavingsDataset($userId)
        );

        $transaction = $this->createUserAccountTransactionService
            ->makeDeposit($userId, $account['id'], $initialBalance);

        return $transaction['account'];
    }

    public function createCheckingAccountWithBalance(
        int $userId,
        int $initialBalance
    ): array {

        $account = $this->userAccountRepository->createNewUserAccount(
            new UserAccountCheckingDataset($userId)
        );

        $transaction = $this->createUserAccountTransactionService
            ->makeDeposit($userId, $account['id'], $initialBalance);

        return $transaction['account'];
    }
}
