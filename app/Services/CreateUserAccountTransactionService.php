<?php

namespace App\Services;

use App\Dataset\UserAccount\UpdateUserAccountBalanceDataset;
use App\Dataset\UserAccountDepositTransactionDataset;
use App\Dataset\UserAccountTransactionDataset;
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

        $this->organizeBanknotes($transaction);

        $transaction = $this->userAccountTransactionRepository
                ->createNewAccountTransaction($transaction);

        $account = $this->userAccountRepository->updateUserAccountBalance(
            new UpdateUserAccountBalanceDataset(
                $transaction['user_account_id'],
                $transaction['transacted_amount'],
            )
        );
    
            return array_merge(
                $transaction,
                ['account' => $account]
            );
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

    private function organizeBanknotes(UserAccountTransactionDataset $transactionDataset): void
    {

        $usedBanknotes = [];
        $absoluteWithdrawAmount = $transactionDataset->getAbsoluteTransactedAmount();

        foreach ($this->availableBanknotes->reverse() as $banknote) {

            if ($absoluteWithdrawAmount === 0) {
                $usedBanknotes[$banknote] = [
                        'units' => 0,
                        'total' => 0
                ];
                continue;
            }

            $rest = $absoluteWithdrawAmount % $banknote;
            $banknoteUnits = floor($absoluteWithdrawAmount / $banknote);
            $usedBanknotes[$banknote] = [
                'units' => (int) $banknoteUnits,
                'total' => $absoluteWithdrawAmount - $rest
            ];
            $absoluteWithdrawAmount = $rest;
        }

        if ($absoluteWithdrawAmount > 0) {
            throw new DomainException(
                "Valor solicitado não é válido de acordo com as cédulas disponível: " .
                $this->availableBanknotes
            );
        }

        $transactionDataset->setUsedBanknotes($usedBanknotes);
    }

    public function makeWithdraw(
        int $userId,
        int $accountId,
        int $transactionAmount
    ): array {

        $transaction = new UserAccountWithdrawTransactionDataset(
            $userId,
            $accountId,
            $transactionAmount
        );

        $this->validateWithdraw($transaction);

        $this->organizeBanknotes($transaction);

        $transaction = $this->userAccountTransactionRepository
            ->createNewAccountTransaction($transaction);

        $account = $this->userAccountRepository->updateUserAccountBalance(
            new UpdateUserAccountBalanceDataset(
                $transaction['user_account_id'],
                $transaction['transacted_amount'],
            )
        );

        return array_merge(
            $transaction,
            ['account' => $account]
        );
    }
}
