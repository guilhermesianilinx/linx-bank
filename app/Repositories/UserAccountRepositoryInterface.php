<?php

namespace App\Repositories;

use App\Dataset\UserAccountDataset;
use App\Models\UserAccount;

interface UserAccountRepositoryInterface
{

    public function __construct(UserAccount $userAccountModel);

    public function createNewUserAccount(UserAccountDataset $userAccountDataset): array;
}
