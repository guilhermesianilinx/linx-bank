<?php

namespace App\Repositories;

use App\Dataset\UserAccountDataset;
use App\Models\UserAccount;

class UserAccountRepository implements UserAccountRepositoryInterface
{

    private UserAccount $userAccountEloquentModel;

    public function __construct(UserAccount $userAccountModel)
    {
        $this->userAccountEloquentModel = $userAccountModel;
    }

    public function createNewUserAccount(UserAccountDataset $userAccountDataset): array
    {
        $this->userAccountEloquentModel->user_id = $userAccountDataset->getUserId();
        $this->userAccountEloquentModel->account_type_id = $userAccountDataset->getAccountTypeId();
        $this->userAccountEloquentModel->balance = UserAccount::INITIAL_BALANCE;
        $this->userAccountEloquentModel->enabled = UserAccount::ACCOUNT_ENABLED;
        $this->userAccountEloquentModel->save();

        return $this->userAccountEloquentModel->toArray();
    }
}
