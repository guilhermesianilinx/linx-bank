<?php

namespace App\Dataset\UserAccount;

abstract class UserAccountDataset
{

    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    abstract public function getAccountTypeId(): int;

    public function getUserId(): int
    {
        return $this->userId;
    }

}
