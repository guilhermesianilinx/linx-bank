<?php

namespace App\Services;

use App\Dataset\UserAccountDepositTransactionDataset;
use App\Dataset\UserAccountWithdrawTransactionDataset;
use App\Repositories\UserAccountRepositoryInterface;
use App\Repositories\UserAccountTransactionRepositoryInterface;
use DomainException;
use Illuminate\Support\Collection;

class CreateUserAccountTransactionService
{

    private Collection $availableBanknotes;

    private UserAccountRepositoryInterface $userAccountRepository;
    private UserAccountTransactionRepositoryInterface $userAccountTransactionRepository;

    public function __construct(
        UserAccountRepositoryInterface $userAccountRepository,
        UserAccountTransactionRepositoryInterface $userAccountTransactionRepository
    ) {
        $this->userAccountRepository = $userAccountRepository;
        $this->userAccountTransactionRepository = $userAccountTransactionRepository;

        $this->setAvailableBanknotes();
    }

    private function setAvailableBanknotes(): void
    {
        $availableBanknotes = collect([
            20, 50, 100
        ]);

        $this->availableBanknotes = $availableBanknotes->sort();
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

    private function validateWithdraw(UserAccountWithdrawTransactionDataset $transactionDataset): void
    {

        if ($transactionDataset->getAbsoluteTransactedAmount() < $this->availableBanknotes->first()) {
            throw new DomainException(
                "Valor solicitado ". $transactionDataset->getAbsoluteTransactedAmount() .
                " menor que o valor que a menor cédula disponível - " . 
                $this->availableBanknotes->first()
            );
        }

        if ($transactionDataset->getAbsoluteTransactedAmount() % 10 > 0) {
            throw new DomainException(
                "Valor solicitado não é divisível pelo mínimo"
            );
        }

        $account = $this->userAccountRepository
            ->findAccountById($transactionDataset->getUserAccountId());
        if ($transactionDataset->getAbsoluteTransactedAmount() > $account['balance']) {
            throw new DomainException(
                "Valor solicitado é maior que saldo disponível - " . $account['balance']
            );
        }
    }

    public function makeWithdraw(
        int $userId,
        int $accountId,
        int $depositAmount
    ): array {

        $transaction = new UserAccountWithdrawTransactionDataset(
            $userId,
            $accountId,
            $depositAmount
        );

        $this->validateWithdraw($transaction);

        return $this->userAccountTransactionRepository
            ->createNewAccountTransaction($transaction);
    }
}
