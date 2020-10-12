<?php

namespace App\Dataset;

class UserAccountDataset
{

    private int $userId;
    private int $accountTypeId;

    public function __construct(int $userId, int $accountTypeId)
    {
        $this->userId = $userId;
        $this->accountTypeId = $accountTypeId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAccountTypeId(): int
    {
        return $this->accountTypeId;
    }
}
