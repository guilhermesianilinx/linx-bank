<?php

namespace App\Repositories;

use App\Dataset\UserAccountTransactionDataset;
use App\Models\UserAccountTransaction;

class UserAccountTransactionRepository implements UserAccountTransactionRepositoryInterface
{

    private UserAccountTransaction $userAccountTransactionEloquentModel;

    public function __construct(UserAccountTransaction $userAccountTransactionModel)
    {
        $this->userAccountTransactionEloquentModel = $userAccountTransactionModel;
    }

    public function createNewAccountTransaction(UserAccountTransactionDataset $userAccountTransactionDataset): array
    {
        $this->userAccountTransactionEloquentModel->user_id = $userAccountTransactionDataset->getUserId();
        $this->userAccountTransactionEloquentModel->user_account_id = $userAccountTransactionDataset->getUserAccountId();
        $this->userAccountTransactionEloquentModel->transacted_amount = $userAccountTransactionDataset->getTransactedAmount();
        $this->userAccountTransactionEloquentModel->used_banknotes = $userAccountTransactionDataset->getUsedBanknotes();
        $this->userAccountTransactionEloquentModel->save();

        return $this->userAccountTransactionEloquentModel->toArray();
    }
}
