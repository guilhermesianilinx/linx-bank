<?php

namespace App\Dataset;

class UserAccountWithdrawTransactionDataset extends UserAccountTransactionDataset
{

    protected function getTransactionFactor(): int
    {
        return -1;
    }
}
