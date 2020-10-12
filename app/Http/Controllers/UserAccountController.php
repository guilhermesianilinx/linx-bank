<?php

namespace App\Http\Controllers;

use App\Dataset\UserAccountDataset;
use App\Repositories\UserAccountRepositoryInterface;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{

    private UserAccountRepositoryInterface $userAccountRepository;

    public function __construct(UserAccountRepositoryInterface $userAccountRepository)
    {
        $this->userAccountRepository = $userAccountRepository;
    }

    public function store(Request $request, int $id, string $type)
    {

        $userAccountDataset = new UserAccountDataset(
            $id,
            1,
        );

        $newUserAccount = $this->userAccountRepository
            ->createNewUserAccount($userAccountDataset);

        return response($newUserAccount, 201);
    }
}
