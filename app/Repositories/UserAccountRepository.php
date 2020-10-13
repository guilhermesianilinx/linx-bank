<?php

namespace App\Repositories;

use App\Dataset\UserAccount\UpdateUserAccountBalanceDataset;
use App\Dataset\UserAccount\UserAccountDataset;
use App\Exceptions\InsufficientFundsException;
use App\Models\UserAccount;
use DomainException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserAccountRepository implements UserAccountRepositoryInterface
{

    private UserAccount $userAccountEloquentModel;

    public function __construct(UserAccount $userAccountModel)
    {
        $this->userAccountEloquentModel = $userAccountModel;
    }

    public function findAccountById(int $id): array
    {
        $account = $this->userAccountEloquentModel->find($id);

        if ($account === null) {
            throw new ModelNotFoundException();
        }

        return $account->toArray();
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

    public function updateUserAccountBalance(UpdateUserAccountBalanceDataset $userAccountDataset): array
    {

        /** @var UserAccount */
        $account = $this->userAccountEloquentModel
            ->lockForUpdate()
            ->find($userAccountDataset->getAccountId());

        $newBalance = $account->balance + $userAccountDataset->getTransactedAmount();
        if ($newBalance < 0) {
            throw new InsufficientFundsException(
                $account->balance,
                $userAccountDataset->getTransactedAmount());
        }

        $account->balance += $userAccountDataset->getTransactedAmount();
        $account->save();

        return $account->toArray();
    }
}
