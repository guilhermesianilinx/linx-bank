<?php

namespace App\Repositories;

use App\Dataset\UserAccount\UpdateUserAccountBalanceDataset;
use App\Dataset\UserAccount\UserAccountDataset;
use App\Models\UserAccount;

interface UserAccountRepositoryInterface
{

    public function __construct(UserAccount $userAccountModel);

    public function createNewUserAccount(UserAccountDataset $userAccountDataset): array;

    public function updateUserAccountBalance(UpdateUserAccountBalanceDataset $userAccountDataset): array;
}
