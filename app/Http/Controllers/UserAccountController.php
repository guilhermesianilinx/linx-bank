<?php

namespace App\Http\Controllers;

use App\Dataset\UserAccount\UserAccountSavingsDataset;
use App\Dataset\UserAccountDataset;
use App\Repositories\UserAccountRepositoryInterface;
use App\Services\CreateUserAccountService;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{

    private UserAccountRepositoryInterface $userAccountRepository;
    private CreateUserAccountService $createUserAccountService;

    public function __construct(UserAccountRepositoryInterface $userAccountRepository,
        CreateUserAccountService $createUserAccountService)
    {
        $this->userAccountRepository = $userAccountRepository;
        $this->createUserAccountService = $createUserAccountService;
    }

    public function store(Request $request, int $id, string $type)
    {

        $userAccountDataset = new UserAccountSavingsDataset($id);

        $newUserAccount = $this->userAccountRepository
            ->createNewUserAccount($userAccountDataset);

        return response($newUserAccount, 201);
    }

    public function storeSavingsAccount(Request $request, int $userId)
    {
        $savingAccount = $this->createUserAccountService->createSavingsAccountWithBalance(
            $userId,
            $request->get('initial_balance')
        );

        return response($savingAccount, 201);
    }

    public function storeCheckingAccount(Request $request, int $userId)
    {
        $checkingAccount = $this->createUserAccountService->createCheckingAccountWithBalance(
            $userId,
            $request->get('initial_balance')
        );

        return response($checkingAccount, 201);
    }
}
