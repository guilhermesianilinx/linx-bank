<?php

namespace App\Dataset\UserAccount;

use App\Models\UserAccountType;

class UserAccountSavingsDataset extends UserAccountDataset
{

    public function getAccountTypeId(): int
    {
        return UserAccountType::SAVINGS;
    }
}
