<?php

namespace App\Http\Controllers;

use App\Dataset\UserDataSet;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->getAllUsers();
    }

    public function show(int $id)
    {
        try {
            return $this->userRepository->findUserById($id);
        } catch (ModelNotFoundException $exception) {
            return response($exception->getMessage(), 404);
        }
    }

    public function store(Request $request)
    {

        $this->validate($request, User::$createRules);

        $userDataSet = new UserDataSet(
            $request->get('name'),
            $request->get('cpf'),
            $request->get('born_at'),
        );

        $newUser = $this->userRepository
            ->createNewUser($userDataSet);

        return response($newUser, 201);
    }
}
