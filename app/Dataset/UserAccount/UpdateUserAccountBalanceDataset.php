<?php

namespace App\Dataset\UserAccount;

class UpdateUserAccountBalanceDataset 
{

    private int $accountId;
    private int $transactedAmount;

    public function __construct(int $accountId, int $transactedAmount)
    {
        $this->accountId = $accountId;
        $this->transactedAmount = $transactedAmount;
    }

    public function getAccountId(): int
    {
        return $this->accountId;
    }

    public function getTransactedAmount(): int
    {
        return $this->transactedAmount;
    }
}