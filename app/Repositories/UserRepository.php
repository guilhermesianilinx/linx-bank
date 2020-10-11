<?php

namespace App\Repositories;

use App\Dataset\UserDataSet;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{

    private User $userEloquentModel;

    public function __construct(User $userModel) {
        $this->userEloquentModel = $userModel;
    }

    public function getAllUsers(): Collection
    {
        return $this->userEloquentModel->all()->map->toArray();
    }

    public function createNewUser(UserDataSet $userDataSet): array
    {
        $this->userEloquentModel->name = $userDataSet->getName();
        $this->userEloquentModel->cpf = $userDataSet->getCpf();
        $this->userEloquentModel->born_at = $userDataSet->getBornAt();
        $this->userEloquentModel->save();

        return $this->userEloquentModel->toArray();
    }

}