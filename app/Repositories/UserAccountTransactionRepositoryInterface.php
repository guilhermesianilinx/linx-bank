<?php

namespace App\Repositories;

use App\Dataset\UserAccountTransactionDataset;
use App\Models\UserAccountTransaction;

interface UserAccountTransactionRepositoryInterface
{

    public function __construct(UserAccountTransaction $userAccountTransactionModel);

    public function createNewAccountTransaction(UserAccountTransactionDataset $userAccountTransactionDataset): array;
}
