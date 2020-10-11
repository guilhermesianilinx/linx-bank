<?php

namespace App\Repositories;

use App\Dataset\UserDataSet;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{

    public function __construct(User $userModel);

    public function getAllUsers(): Collection;

    public function createNewUser(UserDataSet $user): array;

}