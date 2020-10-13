<?php

namespace App\Dataset;

abstract class UserAccountTransactionDataset
{

    private int $userId;
    private int $userAccountId;
    private int $transactedAmount;

    public function __construct(int $userId, int $userAccountId, int $transactedAmount)
    {
        $this->userId = $userId;
        $this->userAccountId = $userAccountId;
        $this->transactedAmount = $transactedAmount;
    }

    abstract protected function getTransactionFactor(): int;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserAccountId(): int
    {
        return $this->userAccountId;
    }

    public function getTransactedAmount(): int
    {
        return $this->transactedAmount * $this->getTransactionFactor();
    }

    public function getAbsoluteTransactedAmount(): int
    {
        return $this->transactedAmount;
    }
}
