<?php

namespace App\Dataset;

class UserAccountDepositTransactionDataset extends UserAccountTransactionDataset
{

    protected function getTransactionFactor(): int
    {
        return 1;
    }
}
