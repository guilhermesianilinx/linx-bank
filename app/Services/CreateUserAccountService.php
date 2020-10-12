<?php

namespace App\Services;

use App\Dataset\UserAccount\UpdateUserAccountBalanceDataset;
use App\Dataset\UserAccount\UserAccountCheckingDataset;
use App\Dataset\UserAccount\UserAccountSavingsDataset;
use App\Dataset\UserAccountDepositTransactionDataset;
use App\Repositories\UserAccountRepositoryInterface;
use App\Repositories\UserAccountTransactionRepositoryInterface;

class CreateUserAccountService
{

    private UserAccountRepositoryInterface $userAccountRepository;
    private UserAccountTransactionRepositoryInterface $userAccountTransactionRepository;

    public function __construct(
        UserAccountRepositoryInterface $userAccountRepository,
        UserAccountTransactionRepositoryInterface $userAccountTransactionRepository
    ) {
        $this->userAccountRepository = $userAccountRepository;
        $this->userAccountTransactionRepository = $userAccountTransactionRepository;
    }

    public function createSavingsAccountWithBalance(
        int $userId,
        int $initialBalance
    ): array {

        $account = $this->userAccountRepository->createNewUserAccount(
            new UserAccountSavingsDataset($userId)
        );

        $accountTransaction = $this->userAccountTransactionRepository
            ->createNewAccountTransaction(
                new UserAccountDepositTransactionDataset(
                    $userId,
                    $account['id'],
                    $initialBalance
                )
            );

        $account = $this->userAccountRepository->updateUserAccountBalance(
            new UpdateUserAccountBalanceDataset(
                $accountTransaction['user_account_id'],
                $accountTransaction['transacted_amount'],
            )
        );

        return $account;
    }

    public function createCheckingAccountWithBalance(
        int $userId,
        int $initialBalance
    ): array {

        $account = $this->userAccountRepository->createNewUserAccount(
            new UserAccountCheckingDataset($userId)
        );

        $accountTransaction = $this->userAccountTransactionRepository
            ->createNewAccountTransaction(
                new UserAccountDepositTransactionDataset(
                    $userId,
                    $account['id'],
                    $initialBalance
                )
            );

        return array_merge(
            $account,
            ['balance' => $accountTransaction['transacted_amount']]
        );
    }
}
