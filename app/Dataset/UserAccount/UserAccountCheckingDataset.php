<?php

namespace App\Dataset\UserAccount;

use App\Models\UserAccountType;

class UserAccountCheckingDataset extends UserAccountDataset
{

    public function getAccountTypeId(): int
    {
        return UserAccountType::CHECKING;
    }
}
